import React, { FC } from 'react';
import { Filter, TextInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';

interface MetadataFilterParams {
    code?: string;
    title?: string;
}

const MetadataFilter: FC<FilterProps<MetadataFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='Code' source='code' allowEmpty />
        <TextInput label='Title' source='title' allowEmpty />
    </Filter>
);

export default MetadataFilter;
