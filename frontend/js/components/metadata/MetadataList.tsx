import React, { ReactElement } from 'react';
import { List, Datagrid, TextField, EditButton } from 'react-admin';
import MetadataFilter from './MetadataFilter';

const MetadataList = (props): ReactElement => {
    return (
        <List filters={<MetadataFilter />} exporter={false} {...props}>
            <Datagrid>
                <TextField source='code' />
                <TextField source='title' />
                <EditButton />
            </Datagrid>
        </List>
    );
};

export default MetadataList;
