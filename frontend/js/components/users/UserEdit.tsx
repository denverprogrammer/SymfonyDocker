import React, { ReactElement } from 'react';
import { TextInput } from 'react-admin';
import { Edit, SimpleForm } from 'react-admin';
import UserTitle from './UserTitle';

const UserEdit = (props): ReactElement => (
    <Edit title={<UserTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source='id' />
            <TextInput source='username' />
            <TextInput source='email' type='email' />
        </SimpleForm>
    </Edit>
);

export default UserEdit;
