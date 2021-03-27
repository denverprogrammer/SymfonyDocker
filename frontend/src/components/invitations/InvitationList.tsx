import React, { ReactElement } from 'react';
import { DateField, TextField, ShowButton, List, Datagrid } from 'react-admin';
import InvitationFilter from './InvitationFilter';

const InvitationList = (props): ReactElement => {
    return (
        <List filters={<InvitationFilter />} exporter={false} {...props}>
            <Datagrid>
                <DateField label='Created On' source='created' />
                <DateField label='Updated On' source='updated' />
                <TextField label='Recipient Type' source='recipientType' />
                <TextField label='Recipient' source='recipient' />
                <ShowButton />
            </Datagrid>
        </List>
    );
};

export default InvitationList;
