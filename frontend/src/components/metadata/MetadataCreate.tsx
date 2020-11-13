import React, { ReactElement } from 'react';
import { Create, SimpleForm, TextInput } from 'react-admin';

const MetadataCreate = (props): ReactElement => (
    <Create title='Create a Metadata' {...props}>
        <SimpleForm>
            <TextInput source='code' />
            <TextInput source='title' />
        </SimpleForm>
    </Create>
);

export default MetadataCreate;
