import React, { ReactElement } from 'react';
import { ReferenceInput, SelectInput, Create, SimpleForm, TextInput } from 'react-admin';

const StockCreate = (props): ReactElement => (
    <Create title='Create a Stock' {...props}>
        <SimpleForm>
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
    </Create>
);

export default StockCreate;
