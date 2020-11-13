import React, { ReactElement } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';

import { Admin, Resource } from 'react-admin';

// Icons
import AccountBalance from '@material-ui/icons/AccountBalance';
import Email from '@material-ui/icons/Email';
import Laptop from '@material-ui/icons/Laptop';
import Category from '@material-ui/icons/Category';

// Theme and helpers
import theme from './helper/theme';
import authProvider from './helper/authProvider';
import dataProvider from './helper/dataProvider';

// UI pages
import Dashboard from './components/Dashboard';
import LoginForm from './components/forms/LoginForm';
import LogoutButton from './components/home/LogoutButton';
import trackrecords from './components/trackrecords';
import stocks from './components/stocks';
import metadata from './components/metadata';
import subscriptions from './components/subscriptions';
import invitations from './components/invitations';
import users from './components/users';
import routes from './helper/routes';

const App = (): ReactElement => (
    <Router>
        <Admin
            authProvider={authProvider}
            customRoutes={routes}
            dashboard={Dashboard}
            dataProvider={dataProvider}
            loginPage={LoginForm}
            logoutButton={LogoutButton}
            theme={theme}
        >
            <Resource name='users' {...users} />
            <Resource name='exchanges' {...metadata} icon={AccountBalance} />
            <Resource name='markets' {...metadata} icon={Laptop} />
            <Resource name='invitations' {...invitations} icon={Email} />
            <Resource name='securities' {...metadata} icon={Category} />
            <Resource name='stocks' {...stocks} />
            <Resource name='trackrecords' {...trackrecords} />
            <Resource name='subscriptions' {...subscriptions} />
        </Admin>
    </Router>
);

ReactDOM.render(<App />, document.getElementById('root'));
