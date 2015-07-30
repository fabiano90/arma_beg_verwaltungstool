/*
    This file is generated and updated by Sencha Cmd. You can edit this file as
    needed for your application, but these edits will have to be merged by
    Sencha Cmd when it performs code generation tasks such as generating new
    models, controllers or views and when running "sencha app upgrade".

    Ideally changes to this file would be limited and most work would be done
    in other places (such as Controllers). If Sencha Cmd cannot merge your
    changes and its generated code, it will produce a "merge conflict" that you
    will need to resolve manually.
    */

    Ext.application({
        name: 'SenchaTouchMVC',

        requires: [
        'Ext.MessageBox',
        'Ext.Ajax'
        ],

        icon: {
            '57': 'resources/icons/Icon.png',
            '72': 'resources/icons/Icon~ipad.png',
            '114': 'resources/icons/Icon@2x.png',
            '144': 'resources/icons/Icon~ipad@2x.png'
        },

        isIconPrecomposed: true,

        startupImage: {
            '320x460': 'resources/startup/320x460.jpg',
            '640x920': 'resources/startup/640x920.png',
            '768x1004': 'resources/startup/768x1004.png',
            '748x1024': 'resources/startup/748x1024.png',
            '1536x2008': 'resources/startup/1536x2008.png',
            '1496x2048': 'resources/startup/1496x2048.png'
        },

        controllers: ['User', 'Post'],
        views: ['UserView', 'PostList'],
        stores: ['Users', 'Posts'],
        models: ['User', 'Post'],
        googleMaps: false,
        csrfToken: null,

        launch: function() {
    // Destroy the #appLoadingIndicator element
    var that = this;
    Ext.Ajax.on('beforerequest', function (conn, options) {
        if (!(/^http:.*/.test(options.url) || /^https:.*/.test(options.url))) {
            if (options.method == 'POST' || options.method == 'PUT' || options.method == 'DELETE')
            {
                options.jsonData._token = that.csrfToken;
            }
        }
    }, this);
    
    Ext.Ajax.request({
        method: 'GET',
        url: '../login/token',
        success: function(response)
        {
            var obj = Ext.JSON.decode(response.responseText);
            
            
            if (obj.success)
            {
                that.csrfToken = obj.token;
                Ext.fly('appLoadingIndicator').destroy();

                Ext.Viewport.add({
                    xtype: 'mainpanel'
                });
            }
        }
    });

    
    


},

onUpdated: function() {
    Ext.Msg.confirm(
        "Application Update",
        "This application has just successfully been updated to the latest version. Reload now?",
        function(buttonId) {
            if (buttonId === 'yes') {
                window.location.reload();
            }
        }
        );
}

});
