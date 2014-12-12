var linkDetectors = {
    "(\.png|\.jpeg|\.jpg|\.gif|\.tiff|\.svg|\.bmp)$":                'image',
    "http.*gravatar\\.com/avatar/":                                  'image',
    "(\.pdf)$":                                                      'pdf',
    "http.*wikipedia\\.org/wiki/(?!(User|Wikipedia|File|MediaWiki|Template|Help|Category|Portal|Book|Education_Program|TimedText)(_talk)?:)": 'wikipedia',
    "http.*freebase\\.com":                                          'freebase',
    "http.*angel\\.co":                                              'angellist',
    "http.*crunchbase\\.com/(company|person|organization)":          'crunchbase',
    "http.*ultralink\\.me/annotation/":                              'annotation',
    "http.*www\\.amazon\\.(br|ca|com|co\.uk|cn|de|es|fr|in|it|jp)/": 'buyamazon',
    "http.*ebay\.com":                                               'buyebay',
    "http://click\\.linksynergy\\.com.*partnerId%253D30":            'buylinkshareapple',
    "http://click\\.linksynergy\\.com":                              'buy',
    "http.*itunes\\.apple\\.com":                                    'buyapple',
    "http.*www\\.imdb\\.com":                                        'imdb',
    "http.*developer\\.apple\\.com.*/Manpages/":                     'manpage',
    "http.*opengl\\.org.*/docs/man/":                                'manpage',
    "http.*developer\\.palm\\.com/appredirect":                      'appwebos',
    "http.*play\\.google\\.com/store/apps/details":                  'appandroid',
    "http.*linkedin\\.com":                                          'linkedin',
    "http.*facebook\\.com":                                          'facebook',
    "http.*twitter\\.com":                                           'twitter',
    "http.*plus\\.google\\.com":                                     'googleplus',
    "http.*maps\\.google\\.com":                                     'mapgoogle',
    "http.*youtube\\.com":                                           'videoyoutube',
    "http.*vimeo\\.com":                                             'videovimeo',
    "http.*github\\.com":                                            'github',
    "http.*google\\.com/search\?":                                   'searchgoogle',
    "http.*search\\.yahoo\\.com/search\?":                           'searchyahoo',
    "http.*bing\\.com/search\?":                                     'searchbing',
    "http.*ark\\.intel\\.com/products\/":                            'intelark',
    "http.*comicvine\\.com\/":                                       'comicvine',
    "http.*webmd\\.com\/":                                           'webmd',
    "xmpp:.*":                                                       'xmpp'
};

function linkType( url )
{
    for( var detector in linkDetectors )
    {
        if( url.match(RegExp(detector, "i")) )
        {
            return linkDetectors[detector];
        }
    }
    
    return 'href';
}
