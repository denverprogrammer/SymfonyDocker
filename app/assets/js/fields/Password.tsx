import React from 'react';
import InputTypes from './InputTypes';

export default function Password({title='Password', name='password', value='', onChange}: InputTypes) {
    return (
        <div className='form-group'>
            <label htmlFor={`id_{name}`}>{title}</label>
            <input id={`id_{name}`} name={name}
                type='password'
                className='form-control'
                value={value}
                onChange={onChange}
            />
        </div>
    );
}
