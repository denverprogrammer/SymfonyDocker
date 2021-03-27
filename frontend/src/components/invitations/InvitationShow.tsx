import React, { ReactElement } from 'react';
import { RichTextField, DateField, TextField, Show, SimpleShowLayout } from 'react-admin';
import InvitationTitle from './InvitationTitle';

const InvitationShow = (props): ReactElement => (
    <Show title={<InvitationTitle />} {...props}>
        <SimpleShowLayout>
            <TextField label='Recipient Type' source='recipientType' />
            <TextField label='recipient' source='recipient' />
            <DateField label='Created On' source='created' />
            <DateField label='Updated On' source='updated' />
            <RichTextField label='Message' source='message' />
        </SimpleShowLayout>
    </Show>
);

export default InvitationShow;
