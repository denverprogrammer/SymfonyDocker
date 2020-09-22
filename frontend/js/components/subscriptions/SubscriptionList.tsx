import React, { ReactElement } from 'react';
import { ShowButton } from 'react-admin';
import { List, Datagrid, DateField, TextField, ReferenceField } from 'react-admin';
import SubscriptionFilter from './SubscriptionFilter';

const SubscriptionList = (props): ReactElement => {
    return (
        <List filters={<SubscriptionFilter />} exporter={false} {...props}>
            <Datagrid>
                <ReferenceField source='user' reference='users'>
                    <TextField source='username' />
                </ReferenceField>
                <ReferenceField source='trackrecord' reference='trackrecords'>
                    <TextField source='title' />
                </ReferenceField>
                <TextField label='User Type' source='userType' />
                <DateField label='Starts On' source='startsOn' />
                <DateField label='Ends On' source='endsOn' allowEmpty />
                <ShowButton />
            </Datagrid>
        </List>
    );
};

export default SubscriptionList;
