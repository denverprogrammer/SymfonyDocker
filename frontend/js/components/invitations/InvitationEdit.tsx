import React, { ReactElement } from 'react';
import { Edit, SimpleForm, TextInput } from 'react-admin';
import InvitationTitle from './InvitationTitle';
import RichTextInput from 'ra-input-rich-text';

const InvitationEdit = (props): ReactElement => (
    <Edit title={<InvitationTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source='id' />
            <TextInput source='recipientType' />
            <TextInput source='recipient' />
            <RichTextInput source='message' multiline fullWidth />
        </SimpleForm>
    </Edit>
);

export default InvitationEdit;
