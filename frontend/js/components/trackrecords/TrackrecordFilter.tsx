import React, { FC } from 'react';
import { Filter, TextInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';

interface TrackrecordFilterParams {
    title?: string;
}

const TrackrecordFilter: FC<FilterProps<TrackrecordFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='Title' source='title' allowEmpty />
    </Filter>
);

export default TrackrecordFilter;
