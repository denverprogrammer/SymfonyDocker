import { Card, CardContent } from '@material-ui/core';
import React, { ReactElement, useState } from 'react';
import { makeStyles, createStyles, Theme } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import { CalculatorFieldProps } from '../../helper/AppTypes';
import CalculatorForm from '../forms/CalculatorForm';
import CalculatedGrid from './CalculatedGrid';

const CalculatorPage = (): ReactElement => {
    const [settings, setSettings] = useState<CalculatorFieldProps>({
        initialCapital: 10000,
        priceOffset: 0.0,
        riskAmount: 200.0,
        warningPercent: 25,
        dangerPercent: 50,
        startCol: 1,
        increCol: 100,
        startRow: 1.0,
        increRow: 1.0
    });

    const handleCalculatorChange = (fields: CalculatorFieldProps): void => {
        setSettings(fields);
    };

    const handleColIndexChange = (index: number): void => {
        const changed = Object.assign({}, settings);
        changed.startCol = Number(index);
        setSettings(changed);
    };

    const handleRowIndexChange = (index: number): void => {
        console.log('index', index);
        const changed = Object.assign({}, settings);
        changed.startRow = Number(index);
        setSettings(changed);
        console.log('changed', changed);
    };

    const classes = makeStyles((theme: Theme) =>
        createStyles({
            card: {
                flexGrow: 1
            },
            paper: {
                padding: theme.spacing(1),
                textAlign: 'center',
                color: theme.palette.text.secondary
            }
        })
    )();

    return (
        <Card>
            <CardContent className={classes.card}>
                <Grid container item spacing={1}>
                    <Grid item xs={2}>
                        <CalculatorForm
                            initialCapital={settings.initialCapital}
                            priceOffset={settings.priceOffset}
                            riskAmount={settings.riskAmount}
                            warningPercent={settings.warningPercent}
                            dangerPercent={settings.dangerPercent}
                            startCol={settings.startCol}
                            increCol={settings.increCol}
                            startRow={settings.startRow}
                            increRow={settings.increRow}
                            onCalculatorChange={handleCalculatorChange}
                        />
                        <Typography variant='h6'>initial capital: {settings.initialCapital}</Typography>&nbsp;
                        <Typography variant='h6'>price offset: {settings.priceOffset}</Typography>&nbsp;
                        <Typography variant='h6'>risk amount: {settings.riskAmount}</Typography>&nbsp;
                        <Typography variant='h6'>warning percent: {settings.warningPercent}</Typography>&nbsp;
                        <Typography variant='h6'>danger percent: {settings.dangerPercent}</Typography>&nbsp;
                        <Typography variant='h6'>start column: {settings.startCol}</Typography>&nbsp;
                        <Typography variant='h6'>column increment: {settings.increCol}</Typography>&nbsp;
                        <Typography variant='h6'>start row: {settings.startRow}</Typography>&nbsp;
                        <Typography variant='h6'>row increment: {settings.increRow}</Typography>&nbsp;
                    </Grid>
                    <Grid item xs={10}>
                        <CalculatedGrid
                            {...settings}
                            onColIndexChange={handleColIndexChange}
                            onRowIndexChange={handleRowIndexChange}
                        />
                    </Grid>
                </Grid>
            </CardContent>
        </Card>
    );
};

export default CalculatorPage;
