import React, { ReactElement } from 'react';
import { Card, CardContent, CardHeader } from '@material-ui/core';

const Dashboard = (): ReactElement => (
    <Card>
        <CardHeader title='Welcome to the administration' />
        <CardContent>Lorem ipsum sic dolor amet...</CardContent>
    </Card>
);

export default Dashboard;
