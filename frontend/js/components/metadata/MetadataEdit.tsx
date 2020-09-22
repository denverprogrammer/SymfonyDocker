import React, { ReactElement } from 'react';
import { Edit, SimpleForm, TextInput } from 'react-admin';
import MetadataTitle from './MetadataTitle';

const MetadataEdit = (props): ReactElement => (
    <Edit title={<MetadataTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source='id' />
            <TextInput source='code' />
            <TextInput source='title' />
        </SimpleForm>
    </Edit>
);

export default MetadataEdit;
