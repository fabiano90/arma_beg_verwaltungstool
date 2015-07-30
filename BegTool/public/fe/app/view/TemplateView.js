Ext.define('SenchaTouchMVC.view.TemplateView', {
    extend: 'Ext.Panel',
    xtype: 'templateview',
    config: {
    	listeners: {
			initialize: function(comp, item)
			{

				Ext.Ajax.request({
                    url: comp.config.templateFile,
                    method: "GET",
                    success : function( response, request ) {
                      	comp.setHtml(response.responseText);
                    }
                });	
			}
		},
        title: '',
        styleHtmlContent: true,
        html: '',
        templateFile: ''
    }
});
