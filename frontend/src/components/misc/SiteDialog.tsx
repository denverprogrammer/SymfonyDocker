import React, { ReactElement } from 'react';
import { MuiThemeProvider, makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
// import Notification from 'react-admin';
import theme from '../../helper/theme';
import Typography from '@material-ui/core/Typography';

interface SiteDialogProps {
    title: string;
    width: number;
    children: ReactElement;
}

const SiteDialog = ({ title, width, children }: SiteDialogProps): ReactElement => {
    const classes = makeStyles({
        main: {
            display: 'flex',
            flexDirection: 'column',
            minHeight: '100vh',
            height: '1px',
            alignItems: 'center',
            justifyContent: 'flex-start',
            backgroundRepeat: 'no-repeat',
            backgroundSize: 'cover',
            backgroundImage: 'radial-gradient(circle at 50% 14em, #313264 0%, #00023b 60%, #00023b 100%)'
        },
        card: {
            minWidth: width,
            margin: '6em',
            padding: '.5em'
        }
    })();

    return (
        <MuiThemeProvider theme={theme}>
            <div className={classes.main}>
                <Card className={classes.card}>
                    <Typography variant='h4' align='center'>
                        {title}
                    </Typography>
                    {children}
                </Card>
                {/* <Notification /> */}
            </div>
        </MuiThemeProvider>
    );
};

export default SiteDialog;
