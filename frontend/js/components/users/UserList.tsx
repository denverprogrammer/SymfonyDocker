import React, { ReactElement } from 'react';
import { List, Datagrid, TextField, EmailField } from 'react-admin';

const UserList = (props): ReactElement => (
    <List {...props}>
        <Datagrid rowClick='edit'>
            <TextField source='id' />
            <TextField source='username' />
            <EmailField source='email' />
        </Datagrid>
    </List>
);

export default UserList;
