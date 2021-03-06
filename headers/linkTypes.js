var linkTypes = {
    'image':             "Image",
    'pdf':               "PDF",
    'href':              "Link",
    'href2':             "Link 2",
    'href3':             "Link 3",
    'buy':               "Buy",
    'video':             "Video",
    'videoyoutube':      "YouTube",
    'videovimeo':        "Vimeo",
    'videovlc':          "VLC",
    'buylinkshareapple': "Buy From Apple",
    'buyapple':          "Buy From Apple",
    'buyamazon':         "Buy From Amazon",
    'buyebay':           "Buy From Ebay",
    'appios':            "iOS App",
    'appmac':            "Mac App",
    'appwebos':          "webOS App",
    'appandroid':        "Android App",
    'appwindows':        "Windows App",
    'github':            "GitHub",
    'imdb':              "IMDB Profile",
    'espn':              "ESPN Profile",
    'webmd':             "WebMD",
    'manpage':           "Documentation",
    'twitter':           "Twitter",
    'linkedin':          "LinkedIn",
    'facebook':          "Facebook",
    'googleplus':        "Google+",
    'wikipedia':         "Wikipedia",
    'mediawiki':         "MediaWiki",
    'freebase':          "Freebase",
    'angellist':         "AngelList",
    'crunchbase':        "CrunchBase",
    'intelark':          "Intel ARK",
    'comicvine':         "Comic Vine",
    'annotation':        "Annotation",
    'map':               "Map",
    'mapgoogle':         "Google Map",
    'xmpp':              "Jabber",
    'search':            "Search",
    'searchgoogle':      "Google Search",
    'searchyahoo':       "Yahoo Search",
    'searchbing':        "Bing Search",
    'searchpubmed':      "PubMed Search",
    'searchul':          "Search Ultralinks"
};

var linkTypeCategories = {
    'Image':      [ "image" ],
    'Link':       [ "href", "href2", "href3" ],
    'App':        [ "appios", "appmac", "appwebos", "appandroid", "appwindows" ],
    'Buy':        [ "buy", "buylinkshareapple", "buyapple", "buyamazon", "buyebay" ],
    'Social':     [ "twitter", "linkedin", "googleplus", "facebook" ],
    'Reference':  [ "wikipedia", "mediawiki", "imdb", "espn", "webmd", "github", "freebase", "angellist", "crunchbase", "manpage", "map", "mapgoogle", "intelark", "comicvine" ],
    'Video':      [ "video", "videoyoutube", "videovimeo", "videovlc" ],
    'Annotation': [ "annotation" ],
    'Chat':       [ "xmpp" ],
    'Search':     [ "searchul", "search", "searchgoogle", "searchyahoo", "searchbing", "searchpubmed" ]
};

var linkInlineDependencies = {
    'wikipedia':    "",
    'mediawiki':    "",
    'annotation':   "",
    'videoyoutube': "",
    'videovimeo':   "",
    'mapgoogle':    "",
    'ultralinkme':  "",
    'twitter':      "twitter",
    'linkedin':     "linkedin",
    'googleplus':   "googleplus",
    'facebook':     "facebook",
    'angellist':    "angellist",
    'crunchbase':   "ultralinkme",
    'buyamazon':    "ultralinkme",
    'intelark':     "ultralinkme",
    'comicvine':    "ultralinkme"
};

var customLinkTypes = {};
