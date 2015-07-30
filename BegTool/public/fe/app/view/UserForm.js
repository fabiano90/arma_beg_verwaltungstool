Ext.define('SenchaTouchMVC.view.UserForm', {
    extend: 'Ext.form.Panel',
    xtype: 'userform',
    
    config: {
        title: 'Details',
        
        scrollable: true,
        
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        items: [
            
            {
                xtype: 'textfield',
                label: 'Nachname',
                name: 'lastname'
            },
            {
                xtype: 'textfield',
                label: 'Vorname',
                name: 'firstname'
            },
            {
                xtype: 'textfield',
                label: 'E-Mail',
                name: 'email'
            },
            {
                xtype: 'textfield',
                label: 'Benutzername',
                name: 'username'
            },
            {
                xtype: 'textfield',
                label: 'Passwort',
                name: 'password'
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                id: 'usertoolbar',
                items: [
                    {
                        xtype: 'button',
                        text: 'Speichern',
                        itemId: 'usersave'
                        
                    },
                    {
                        xtype: 'button',
                        text: 'Löschen',
                        itemId: 'userdelete'
                        
                    }
                ]
                
            }
            
        ], 

    }
});
