import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { Trackrecord } from '../../helper/AppTypes';

const TrackrecordTitle: FC<FieldProps<Trackrecord>> = ({ record }: FieldProps<Trackrecord>) => (
    <span>Trackrecord {record ? `"${record.title}"` : ''}</span>
);

export default TrackrecordTitle;
