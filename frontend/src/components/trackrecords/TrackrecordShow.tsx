import React, { ReactElement } from 'react';
import { RichTextField, DateField, TextField, ShowButton, Datagrid, Show } from 'react-admin';
import { Tab, TabbedShowLayout, ReferenceField, ReferenceManyField } from 'react-admin';
import TrackrecordTitle from './TrackrecordTitle';

const TrackrecordShow = (props): ReactElement => (
    <Show title={<TrackrecordTitle />} {...props}>
        <TabbedShowLayout>
            <Tab label='Description'>
                <RichTextField source='description' />
            </Tab>
            <Tab label='Subscribers' path='subscriptions'>
                <ReferenceManyField reference='subscriptions' target='trackrecord.id'>
                    <Datagrid>
                        <ReferenceField source='user' reference='users'>
                            <TextField source='username' />
                        </ReferenceField>
                        <TextField label='User Type' source='userType' />
                        <DateField label='Starts On' source='startsOn' />
                        <DateField label='Ends On' source='endsOn' />
                        <ShowButton />
                    </Datagrid>
                </ReferenceManyField>
            </Tab>
        </TabbedShowLayout>
    </Show>
);

export default TrackrecordShow;
