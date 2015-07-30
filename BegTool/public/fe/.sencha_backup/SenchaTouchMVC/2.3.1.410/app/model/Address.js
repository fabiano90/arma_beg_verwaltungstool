Ext.define('SenchaTouchMVC.model.Address', {
    extend: 'Ext.data.Model',
    config: {
        fields: [
            { name: 'id', type: "integer" },
        	{ name: 'name', type: "string" },
        	{ name: 'surname',  type: "string" },
        	{ name: 'room',  type: "string" },
        	{ name: 'phone',  type: "string" }
        ]
    }
});
