Ext.define('SenchaTouchMVC.view.PostList', {
    extend: 'Ext.List',
    xtype: 'postlist',
    config: {
        scrollToTopOnRefresh: true,
        disableSelection: true,
        title: 'Benutzer',
        layout: 'fit',
        itemTpl: '{title}, {content}',
        
        store: 'postStore'/*,
        listeners: {
            painted: function (element, options) {
                this.refresh();
            }
        }*/
    }
});
