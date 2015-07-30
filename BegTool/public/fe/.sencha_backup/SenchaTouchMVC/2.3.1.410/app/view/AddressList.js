Ext.define('SenchaTouchMVC.view.AddressList', {
    extend: 'Ext.List',
    xtype: 'addresslist',
    requires: ['SenchaTouchMVC.store.Addresses'],
    config: {
        scrollToTopOnRefresh: true,
        disableSelection: true,
        title: 'Personen',
        grouped: true,
        layout: 'fit',
        itemTpl: '<img src="https://www.google.de/images/srpr/logo11w.png"/>{name}, {surname}',
        store: 'addressStore',
        listeners: {
            painted: function (element, options) {
                this.refresh();
            }
        }
    }
});
