import React, { FC } from 'react';
import { Filter, TextInput, ReferenceInput, SelectInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';

interface StockFilterParams {
    code?: string;
    title?: string;
}

const StockFilter: FC<FilterProps<StockFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='Code' source='code' allowEmpty />
        <TextInput label='Title' source='title' allowEmpty />
        <ReferenceInput label='Exchange' source='exchange.id' reference='exchanges' allowEmpty>
            <SelectInput optionText='code' />
        </ReferenceInput>
        <ReferenceInput label='Market' source='market.id' reference='markets' allowEmpty>
            <SelectInput optionText='code' />
        </ReferenceInput>
        <ReferenceInput label='Security' source='security.id' reference='securities' allowEmpty>
            <SelectInput optionText='code' />
        </ReferenceInput>
    </Filter>
);

export default StockFilter;
