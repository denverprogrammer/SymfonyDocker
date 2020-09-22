import React, { ReactElement } from 'react';
import { ReferenceInput, SelectInput, Edit, SimpleForm, TextInput } from 'react-admin';
import StockTitle from './StockTitle';

const StockEdit = (props): ReactElement => (
    <Edit title={<StockTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source='id' />
            <TextInput source='code' />
            <TextInput source='title' />
            <ReferenceInput label='Exhcange' source='exchange' reference='exchanges'>
                <SelectInput optionText='code' />
            </ReferenceInput>
            <ReferenceInput label='Market' source='market' reference='markets'>
                <SelectInput optionText='code' />
            </ReferenceInput>
            <ReferenceInput label='Security' source='security' reference='securities'>
                <SelectInput optionText='code' />
            </ReferenceInput>
        </SimpleForm>
    </Edit>
);

export default StockEdit;
