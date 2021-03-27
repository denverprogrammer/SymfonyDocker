import React, { ReactElement } from 'react';
import { Create, SimpleForm, TextInput } from 'react-admin';
import RichTextInput from 'ra-input-rich-text';

const TrackrecordCreate = (props): ReactElement => (
    <Create title='Create a Trackrecord' {...props}>
        <SimpleForm>
            <TextInput source='title' />
            <RichTextInput source='description' multiline fullWidth />
        </SimpleForm>
    </Create>
);

export default TrackrecordCreate;
