import React, { ReactElement } from 'react';
import { Route } from 'react-router-dom';
import CreateAccountForm from '../components/forms/CreateAccountForm';
import ConfirmAccountForm from '../components/forms/ConfirmAccount';
import ResetPasswordForm from '../components/forms/ResetPasswordForm';
import ConfirmPasswordForm from '../components/forms/ConfirmPasswordForm';
import CalculatorPage from '../components/home/CalculatorPage';

const routes = [
    <Route key='movement_calculator' exact path='/movement_calculator' component={CalculatorPage} />,
    <Route key='create_account' exact path='/create_account' component={CreateAccountForm} noLayout />,
    <Route key='reset_password' exact path='/reset_password' component={ResetPasswordForm} noLayout />,
    <Route
        key='confirm_account'
        exact
        path='/confirm_account/:token'
        // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
        // @ts-ignore
        noLayout
        render={(routeProps): ReactElement => (
            <ConfirmAccountForm token={decodeURIComponent(routeProps.match.params.token)} {...routeProps} />
        )}
    />,
    <Route
        key='confirm_password'
        exact
        path='/confirm_password/:token'
        // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
        // @ts-ignore
        noLayout
        render={(routeProps): ReactElement => (
            <ConfirmPasswordForm token={decodeURIComponent(routeProps.match.params.token)} {...routeProps} />
        )}
    />
];

export default routes;
