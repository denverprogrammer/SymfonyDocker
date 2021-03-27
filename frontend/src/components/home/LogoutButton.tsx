// in src/MyLogoutButton.js
import React, { ReactElement, forwardRef } from 'react';
import { useLogout } from 'react-admin';
import MenuItem from '@material-ui/core/MenuItem';
import ExitIcon from '@material-ui/icons/PowerSettingsNew';

const LogoutButton = (props, ref): ReactElement => {
    const logout = useLogout();

    const handleClick = (): Promise<void> => logout();

    return (
        <MenuItem onClick={handleClick} ref={ref}>
            <ExitIcon /> Logout
        </MenuItem>
    );
};

export default forwardRef(LogoutButton);
