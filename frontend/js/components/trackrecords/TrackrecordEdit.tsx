import React, { ReactElement } from 'react';
import { Edit, SimpleForm, TextInput } from 'react-admin';
import RichTextInput from 'ra-input-rich-text';
import TrackrecordTitle from './TrackrecordTitle';

const TrackrecordEdit = (props): ReactElement => (
    <Edit title={<TrackrecordTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source='id' />
            <TextInput source='title' />
            <RichTextInput source='description' multiline fullWidth />
        </SimpleForm>
    </Edit>
);

export default TrackrecordEdit;
