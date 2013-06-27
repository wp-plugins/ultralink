<?php

    require_once('linkTypes.php');
    require_once('globals.php');
    
    $isMultisite = 0; if( function_exists('is_multisite') && is_multisite() ){ $isMultisite = 1; }

    $useMultisiteDatabase = "unchecked";

    global $wpdb;
    global $dbPrefix;

    $dbPrefix = $wpdb->prefix;
    if( !empty($networkAdmin) ){ $dbPrefix = "wp_ms_"; }
    else
    {
        $wpdb->query( "SHOW tables LIKE '" . $wpdb->prefix . "ultralink_config'" );

        if( $wpdb->num_rows > 0 )
        {
            if( $wpdb->get_var( "SELECT useMultisiteDatabase FROM `" . $wpdb->prefix . "ultralink_config`" ) == '1' ){ $dbPrefix = "wp_ms_"; $useMultisiteDatabase = "checked"; }
        }
    }

    function typeOptions($selectedOption)
    {
        global $linkTypes;
        
        $typeString = "";
        foreach( array_keys($linkTypes) as $type )
        {
            if( $type == $selectedOption ){ $typeString .= "<option value='$type' SELECTED>" . $linkTypes[$type] . "</option>"; }
                                      else{ $typeString .= "<option value='$type'>" . $linkTypes[$type] . "</option>"; }
        }
        return $typeString;
    }
    
    function time2str($ts)
	{
		if(!ctype_digit($ts))
			$ts = strtotime($ts);

		$diff = time() - $ts;
		if($diff == 0)
			return 'now';
		elseif($diff > 0)
		{
			$day_diff = floor($diff / 86400);
			if($day_diff == 0)
			{
				if($diff < 60) return 'just now';
				if($diff < 120) return '1 minute ago';
				if($diff < 3600) return floor($diff / 60) . ' minutes ago';
				if($diff < 7200) return '1 hour ago';
				if($diff < 86400) return floor($diff / 3600) . ' hours ago';
			}
			if($day_diff == 1) return 'Yesterday';
			if($day_diff < 7) return $day_diff . ' days ago';
			if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
			if($day_diff < 60) return 'last month';
			return date('F Y', $ts);
		}
		else
		{
			$diff = abs($diff);
			$day_diff = floor($diff / 86400);
			if($day_diff == 0)
			{
				if($diff < 120) return 'in a minute';
				if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
				if($diff < 7200) return 'in an hour';
				if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
			}
			if($day_diff == 1) return 'Tomorrow';
			if($day_diff < 4) return date('l', $ts);
			if($day_diff < 7 + (7 - date('w'))) return 'next week';
			if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
			if(date('n', $ts) == date('n') + 1) return 'next month';
			return date('F Y', $ts);
		}
	}
    
//    $options = $wpdb->get_row("SELECT ultralinkEnabled, alwaysSearch, defaultSearch, useMultisiteDatabase, amazonAffiliateTag, linkshareID, ebayPublisherID, ultralinkEnabled, ultralinkMeEmail, ultralinkMeAPIKey, ultralinkMeWebsiteVerifier, UNIX_TIMESTAMP(ultralinkMeLastSync) AS ultralinkMeLastSync, mergeUltralinkMeLinks, ultralinkMeAnalytics, latestAvailableVersion, latestAvailableVersionString FROM " . $dbPrefix . "ultralink_config");
    $options = $wpdb->get_row("SELECT ultralinkEnabled, alwaysSearch, combineSimilarButtons, multipleSearchOptions, linksMakeNewWindows, mouseProximityFade, hasHoverTime, hasPopupRecoveryTime, hoverTime, popupRecoveryTime, defaultSearch, useMultisiteDatabase, amazonAffiliateTag, linkshareID, ebayCampaign, ultralinkEnabled, ultralinkMeEmail, ultralinkMeAPIKey, ultralinkMeWebsiteVerifier, UNIX_TIMESTAMP(ultralinkMeLastSync) AS ultralinkMeLastSync, mergeUltralinkMeLinks, ultralinkMeAnalytics, latestAvailableVersion, latestAvailableVersionString, sourceType, source FROM " . $dbPrefix . "ultralink_config");
    if( is_null($options) )
    {
        if( $wpdb->get_var("SELECT COUNT(*) FROM " . $dbPrefix . "ultralink_config") == 0 )
        {
            $wpdb->query("INSERT INTO " . $dbPrefix . "ultralink_config (defaultSearch) VALUES('google')");
    //        $options = $wpdb->get_row("SELECT ultralinkEnabled, alwaysSearch, defaultSearch, useMultisiteDatabase, amazonAffiliateTag, linkshareID, ebayPublisherID, ultralinkEnabled, ultralinkMeEmail, ultralinkMeAPIKey, ultralinkMeWebsiteVerifier, UNIX_TIMESTAMP(ultralinkMeLastSync) AS ultralinkMeLastSync, mergeUltralinkMeLinks, ultralinkMeAnalytics, latestAvailableVersion, latestAvailableVersionString FROM " . $dbPrefix . "ultralink_config");
            $options = $wpdb->get_row("SELECT ultralinkEnabled, alwaysSearch, combineSimilarButtons, multipleSearchOptions, linksMakeNewWindows, mouseProximityFade, hasHoverTime, hasPopupRecoveryTime, hoverTime, popupRecoveryTime, defaultSearch, useMultisiteDatabase, amazonAffiliateTag, linkshareID, ebayCampaign, ultralinkEnabled, ultralinkMeEmail, ultralinkMeAPIKey, ultralinkMeWebsiteVerifier, UNIX_TIMESTAMP(ultralinkMeLastSync) AS ultralinkMeLastSync, mergeUltralinkMeLinks, ultralinkMeAnalytics, latestAvailableVersion, latestAvailableVersionString, sourceType, source FROM " . $dbPrefix . "ultralink_config");
        }
    }
    
    if( $options->ultralinkEnabled      == 1 ){ $ultralinkEnabled      = "checked"; }else{ $ultralinkEnabled      = "unchecked"; }
    if( $options->alwaysSearch          == 1 ){ $alwaysSearch          = "checked"; }else{ $alwaysSearch          = "unchecked"; }

    if( $options->combineSimilarButtons == 1 ){ $combineSimilarButtons = "checked"; }else{ $combineSimilarButtons = "unchecked"; }
    if( $options->multipleSearchOptions == 1 ){ $multipleSearchOptions = "checked"; }else{ $multipleSearchOptions = "unchecked"; }
    if( $options->linksMakeNewWindows   == 1 ){ $linksMakeNewWindows   = "checked"; }else{ $linksMakeNewWindows   = "unchecked"; }
    if( $options->mouseProximityFade    == 1 ){ $mouseProximityFade    = "checked"; }else{ $mouseProximityFade    = "unchecked"; }

    if( $options->hasHoverTime          == 1 ){ $hasHoverTime          = "checked"; }else{ $hasHoverTime          = "unchecked"; }
    if( $options->hasPopupRecoveryTime  == 1 ){ $hasPopupRecoveryTime  = "checked"; }else{ $hasPopupRecoveryTime  = "unchecked"; }

    $hoverTime         = $options->hoverTime;
    $popupRecoveryTime = $options->popupRecoveryTime;

    $sourceType        = $options->sourceType;
    $source            = $options->source;

    if( $source == '' ){ $source = 'ultralink.me'; }

//    if( $options->hasHoverTime          == 0 ){ $hoverTime         = 100000; }
//    if( $options->hasPopupRecoveryTime  == 0 ){ $popupRecoveryTime =      0; }

    if( $options->mergeUltralinkMeLinks == 1 ){ $mergeUltralinkMeLinks = "checked"; }else{ $mergeUltralinkMeLinks = "unchecked"; }
    if( $options->ultralinkMeAnalytics  == 1 ){ $ultralinkMeAnalytics  = "checked"; }else{ $ultralinkMeAnalytics  = "unchecked"; }

    $defaultSearch = $options->defaultSearch;

    $amazonAffiliateTag = $options->amazonAffiliateTag;
    $linkshareID        = $options->linkshareID;
//    $ebayPublisherID    = $options->ebayPublisherID;
    $ebayCampaign       = $options->ebayCampaign;
    
    $ultralinkMeEmail = $options->ultralinkMeEmail;
    $ultralinkMeAPIKey = $options->ultralinkMeAPIKey;
    $ultralinkMeLastSync = $options->ultralinkMeLastSync; if( $ultralinkMeLastSync == 0 ){ $ultralinkMeLastSync = "Never"; }else{ $ultralinkMeLastSync = time2str($ultralinkMeLastSync); }
    
    $latestAvailableVersion = $options->latestAvailableVersion;
    $latestAvailableVersionString = $options->latestAvailableVersionString;
?>

<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . 'linkTypes.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . 'linkDetectors.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . '../libraries/redips-drag-min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . '../libraries/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . '../libraries/2.5.3-crypto-sha1.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . '../libraries/2.5.3-crypto-md5.js'; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . '../libraries/2.5.3-crypto-min.js'; ?>"></script>
<script type="text/javascript">

    var amazonAffiliateTag = '<?php echo $amazonAffiliateTag; ?>';
    var linkshareID = '<?php echo $linkshareID; ?>';
//    var ebayPublisherID = '<?php echo $ebayPublisherID; ?>';
    var ebayCampaign = '<?php echo $ebayCampaign; ?>';
    
    var ultralinkMeEmail = '<?php echo $ultralinkMeEmail; ?>';
    var ultralinkMeAPIKey = '<?php echo $ultralinkMeAPIKey; ?>';
    var ultralinkMeAnalytics = '<?php echo $ultralinkMeAnalytics; ?>';
    var ultralinkMeLastSync = '<?php echo $ultralinkMeLastSync; ?>';

    var latestAvailableVersion = '<?php echo $latestAvailableVersion; ?>';
    var latestAvailableVersionString = '<?php echo $latestAvailableVersionString; ?>';

    var useMultisiteDatabase = '<?php echo $useMultisiteDatabase; ?>';

    var sourceType = '<?php echo $sourceType; ?>';
    var source = '<?php echo $source; ?>';
    
    var networkAdmin = '<?php echo $networkAdmin; ?>';
    
    Object.size = function(obj){ var size = 0, key; for( key in obj ){ if( obj.hasOwnProperty(key) ) size++; } return size; };

    cumulativeOffset = function(element)
    {
        if( element.getBoundingClientRect ){ return getOffsetRect(element); }else{ return getOffsetSum(element); }
    }

    getOffsetRect = function(element)
    {
        var box = element.getBoundingClientRect();

        var body = document.body;
        var docElem = document.documentElement;

        var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
        var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;

        var clientTop = docElem.clientTop || body.clientTop || 0;
        var clientLeft = docElem.clientLeft || body.clientLeft || 0;

        var top  = box.top +  scrollTop - clientTop;
        var left = box.left + scrollLeft - clientLeft;

        return [Math.round(left), Math.round(top)];
    }

    getOffsetSum = function(element)
    {
        var top=0, left=0;

        while( element )
        {
            top = top + parseInt(elem.offsetTop);
            left = left + parseInt(elem.offsetLeft);
            element = element.offsetParent;
        }

        return [left, top];
    }
    
    function getAPIUsersLink(baseURL, type)
    {
        switch( type )
        {
            case 'wikipedia':
            {
                return baseURL;
            } break;
                
            case 'buyamazon':
            {
                if( amazonAffiliateTag ){ return baseURL.replace("ultralinkme-20", amazonAffiliateTag); }else{ return baseURL; }
            } break;

            case 'buylinkshareapple':
            {
                var lID = "kd7iPVyQ5hM"; if( linkshareID ){ lID = linkshareID; }
                linkshareURL = "http://click.linksynergy.com/fs-bin/stat?id=" + lID + "&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=";
                if( baseURL.match("?") ){ baseURL += "&patnerId=30"; }else{ baseURL += "?partnerId=30"; }
                baseURL = encodeURIComponent(encodeURIComponent(baseURL));
                baseURL = linkshareURL + baseURL;
            } break;
            
            case 'buyebay':
            {
                if( ebayCampaign ){ return baseURL.replace("5337254044", ebayCampaign); }else{ return baseURL; }
            } break;
        }
        
        return baseURL;
    }
    
    function disableEnterKey(e){ if( event.keyCode == 13 ){ return false; } return true; }

</script>
