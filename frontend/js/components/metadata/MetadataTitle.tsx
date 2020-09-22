import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { MetadataInterface } from '../../helper/AppTypes';

const MetadataTitle: FC<FieldProps<MetadataInterface>> = ({ record }: FieldProps<MetadataInterface>) => (
    <span>{record ? `"${record.constructor.name} ${record.title}"` : ''}</span>
);

export default MetadataTitle;
