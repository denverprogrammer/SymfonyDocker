import React, { ReactElement } from 'react';
import { TextField, EditButton, List, Datagrid, ReferenceField } from 'react-admin';
import StockFilter from './StockFilter';

const StockList = (props): ReactElement => {
    return (
        <List filters={<StockFilter />} exporter={false} {...props}>
            <Datagrid>
                <TextField label='Code' source='code' />
                <TextField label='Title' source='title' />
                <ReferenceField source='exchange' reference='exchanges'>
                    <TextField source='code' />
                </ReferenceField>
                <ReferenceField source='market' reference='markets'>
                    <TextField source='code' />
                </ReferenceField>
                <ReferenceField source='security' reference='securities'>
                    <TextField source='code' />
                </ReferenceField>
                <EditButton />
            </Datagrid>
        </List>
    );
};

export default StockList;
