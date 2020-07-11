import React from 'react';
import InputTypes from './InputTypes';

export default function SearchInput({
    title = '',
    name = 'search',
    value = '',
    onChange
}: InputTypes): React.ReactElement {
    return (
        <div className="form-group">
            {title && <label htmlFor={`id_${name}`}>{title}</label>}
            <div className="input-group">
                <input
                    className="form-control"
                    onChange={onChange}
                    id={`id_${name}`}
                    name={name}
                    type="search"
                    value={value}
                />
                <div className="input-group-append">
                    <button className="btn btn-primary" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </div>
    );
}
