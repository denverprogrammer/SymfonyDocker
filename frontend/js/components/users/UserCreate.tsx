import React, { ReactElement } from 'react';
import { TextInput } from 'react-admin';
import { Create, SimpleForm } from 'react-admin';

const UserCreate = (props): ReactElement => (
    <Create title='Invite a User' {...props}>
        <SimpleForm>
            <TextInput source='username' />
            <TextInput source='email' type='email' />
        </SimpleForm>
    </Create>
);

export default UserCreate;
