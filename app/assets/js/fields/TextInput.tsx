import React from 'react';
import InputTypes from './InputTypes';

export default function TextInput({
    title = 'Text',
    name = 'text',
    value = '',
    onChange,
}: InputTypes): React.ReactElement {
    return (
        <div className='form-group'>
            <label htmlFor={`id_${name}`}>{title}</label>
            <input
                id={`id_${name}`}
                name={name}
                type='text'
                className='form-control'
                value={value}
                onChange={onChange}
            />
        </div>
    );
}
