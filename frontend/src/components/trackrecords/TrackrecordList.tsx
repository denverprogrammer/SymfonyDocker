import React, { ReactElement } from 'react';
import { TextField, ShowButton, List, Datagrid } from 'react-admin';
import TrackrecordFilter from './TrackrecordFilter';

const TrackrecordList = (props): ReactElement => {
    return (
        <List filters={<TrackrecordFilter />} exporter={false} {...props}>
            <Datagrid>
                <TextField label='Title' source='title' />
                <TextField label='Description' source='description' />
                <ShowButton />
            </Datagrid>
        </List>
    );
};

export default TrackrecordList;
