import { Create, required, email, SimpleForm, TextInput, SelectInput } from 'react-admin';
import React, { ReactElement } from 'react';
import RichTextInput from 'ra-input-rich-text';
import { RecipientTypeChoices } from '../../helper/AppTypes';

const SiteInvitation = (props): ReactElement => {
    return (
        <Create title='Invite a new user' {...props}>
            <SimpleForm>
                <SelectInput
                    label='Recipient Type'
                    source='recipientType'
                    validate={required()}
                    choices={RecipientTypeChoices}
                    fullWidth
                />
                <TextInput label='Recipient' source='recipient' validate={required()} fullWidth />
                <RichTextInput label='Message' source='message' validate={required()} multiline fullWidth />
            </SimpleForm>
        </Create>
    );
};

export default SiteInvitation;
