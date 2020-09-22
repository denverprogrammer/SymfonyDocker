import { required, SimpleForm, NumberInput } from 'react-admin';
import React, { ReactElement } from 'react';
import { CalculatorFieldProps } from '../../helper/AppTypes';
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import Slider from '@material-ui/core/Slider';

interface OnCalculatorProps extends CalculatorFieldProps {
    startCol: number;
    increCol: number;
    startRow: number;
    increRow: number;
    onCalculatorChange(fields: CalculatorFieldProps): void;
}

const CalculatorForm = ({
    initialCapital,
    priceOffset,
    riskAmount,
    warningPercent,
    dangerPercent,
    startCol,
    increCol,
    startRow,
    increRow,
    onCalculatorChange
}: OnCalculatorProps): ReactElement => {
    const classes = makeStyles({
        root: {
            width: 223.33
        }
    })();

    return (
        <SimpleForm toolbar={null} submitOnEnter={false}>
            <NumberInput
                source='initialCapital'
                value={initialCapital}
                validate={required()}
                fullWidth
                onChange={(e): void =>
                    onCalculatorChange({
                        initialCapital: Number(e.target.value),
                        priceOffset: priceOffset,
                        riskAmount: riskAmount,
                        warningPercent: warningPercent,
                        dangerPercent: dangerPercent,
                        startCol: startCol,
                        increCol: increCol,
                        startRow: startRow,
                        increRow: increRow
                    })
                }
            />
            <NumberInput
                source='priceOffset'
                value={priceOffset}
                validate={required()}
                fullWidth
                onChange={(e): void =>
                    onCalculatorChange({
                        initialCapital: initialCapital,
                        priceOffset: Number(e.target.value),
                        riskAmount: riskAmount,
                        warningPercent: warningPercent,
                        dangerPercent: dangerPercent,
                        startCol: startCol,
                        increCol: increCol,
                        startRow: startRow,
                        increRow: increRow
                    })
                }
            />

            <div className={classes.root}>
                <Typography gutterBottom>Risk Amount</Typography>
                <Slider
                    defaultValue={200}
                    min={50}
                    step={25}
                    max={initialCapital}
                    valueLabelDisplay='auto'
                    value={typeof riskAmount === 'number' ? riskAmount : 50}
                    onChange={(e, newValue: number | number[]): void => {
                        let value = Number(50);

                        if (Array.isArray(newValue) && newValue.length > 0) {
                            value = newValue[0];
                        } else {
                            value = Number(newValue);
                        }

                        onCalculatorChange({
                            initialCapital: initialCapital,
                            priceOffset: priceOffset,
                            riskAmount: value,
                            warningPercent: warningPercent,
                            dangerPercent: dangerPercent,
                            startCol: startCol,
                            increCol: increCol,
                            startRow: startRow,
                            increRow: increRow
                        });
                    }}
                />
            </div>

            <div className={classes.root}>
                <Typography gutterBottom>Targets %</Typography>
                <Slider
                    defaultValue={[25, 50]}
                    valueLabelDisplay='auto'
                    min={0}
                    step={1}
                    max={100}
                    value={[warningPercent, dangerPercent]}
                    onChange={(e, newValue: number | number[]): void => {
                        onCalculatorChange({
                            initialCapital: initialCapital,
                            priceOffset: priceOffset,
                            riskAmount: riskAmount,
                            warningPercent: newValue[0],
                            dangerPercent: newValue[1],
                            startCol: startCol,
                            increCol: increCol,
                            startRow: startRow,
                            increRow: increRow
                        });
                    }}
                />
            </div>

            <div className={classes.root}>
                <Typography gutterBottom>Shares Increment</Typography>
                <Slider
                    defaultValue={100}
                    min={100}
                    step={100}
                    max={1000}
                    valueLabelDisplay='auto'
                    value={typeof increCol === 'number' ? increCol : 1}
                    onChange={(e, newValue: number | number[]): void => {
                        let value = Number(1);

                        if (Array.isArray(newValue) && newValue.length > 0) {
                            value = newValue[0];
                        } else {
                            value = Number(newValue);
                        }

                        onCalculatorChange({
                            initialCapital: initialCapital,
                            priceOffset: priceOffset,
                            riskAmount: riskAmount,
                            warningPercent: warningPercent,
                            dangerPercent: dangerPercent,
                            startCol: startCol,
                            increCol: value,
                            startRow: startRow,
                            increRow: increRow
                        });
                    }}
                />
            </div>

            <NumberInput
                source='rowIncrement'
                value={increRow}
                validate={required()}
                fullWidth
                onChange={(e): void =>
                    onCalculatorChange({
                        initialCapital: initialCapital,
                        priceOffset: priceOffset,
                        riskAmount: riskAmount,
                        warningPercent: warningPercent,
                        dangerPercent: dangerPercent,
                        startCol: startCol,
                        increCol: increCol,
                        startRow: startRow,
                        increRow: Number(e.target.value)
                    })
                }
            />
        </SimpleForm>
    );
};

export default CalculatorForm;
