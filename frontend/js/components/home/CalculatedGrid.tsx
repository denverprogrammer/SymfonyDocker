import React, { ReactElement, useState } from 'react';
import { CalculatorFieldProps, CalculatedRowProps, CalculatedCellProps } from '../../helper/AppTypes';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableFoot from '@material-ui/core/TableFooter';
import Paper from '@material-ui/core/Paper';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import CalculatedCol from './CalculatedCol';
import { makeStyles } from '@material-ui/core/styles';
import TableRow from '@material-ui/core/TableRow';
import TableCell from '@material-ui/core/TableCell';
import Slider from '@material-ui/core/Slider';

interface CalculatforGridProps extends CalculatorFieldProps {
    onColIndexChange: (index: number) => void;
    onRowIndexChange: (index: number) => void;
}

const CalculatedGrid = ({
    initialCapital,
    priceOffset,
    riskAmount,
    warningPercent,
    dangerPercent,
    startCol,
    increCol,
    startRow,
    increRow,
    onColIndexChange,
    onRowIndexChange
}: CalculatforGridProps): ReactElement => {
    const classes = makeStyles({
        table: {
            minWidth: 650
        },
        horizontal: {
            width: '100%'
        },
        vertical: {
            height: '100%'
        }
    })();

    const [colsVisible, setColsVisible] = useState(17);

    const [rowsVisible, setRowVisible] = useState(10);

    const maxCols = initialCapital / increCol - colsVisible;

    const maxRows = initialCapital / increRow - rowsVisible;

    const headers = Array.from({ length: colsVisible }, (_, col) => col).map(function (col) {
        return {
            index: col + startCol,
            shares: (col + startCol) * increCol
        };
    });

    const data = Array.from({ length: rowsVisible }, (_, row) => row).map(function (row): CalculatedRowProps {
        const initialPrice = row + increRow + priceOffset;
        const cells = headers.map(function (col): CalculatedCellProps {
            const initialCost = initialPrice * col.shares;
            const riskPercentage = (initialCost / initialCapital) * 100;
            const range = riskAmount / col.shares;

            return {
                initialPrice: initialPrice,
                initialCost: initialCost,
                riskPercentage: riskPercentage,
                range: range,
                warningPercent: warningPercent,
                dangerPercent: dangerPercent,
                initialCapital: initialCapital,
                shares: col.shares
            };
        });

        return {
            index: row,
            initialPrice: initialPrice,
            cells: cells
        };
    });

    return (
        <TableContainer component={Paper}>
            <Table className={classes.table} aria-label='simple table'>
                <TableHead>
                    <TableRow>
                        <TableCell>Price</TableCell>
                        {headers.map(function (item) {
                            return (
                                <TableCell key={item.index} align='right'>
                                    {item.shares}
                                </TableCell>
                            );
                        })}
                        <TableCell>&nbsp;&nbsp;</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {data.map(function (record): ReactElement {
                        return (
                            <TableRow key={`row: ${record.initialPrice}`}>
                                <TableCell component='th' scope='row'>
                                    {record.initialPrice}
                                </TableCell>
                                {record.cells.map(function (cell) {
                                    return <CalculatedCol key={`${record.initialPrice}, ${cell.shares}`} {...cell} />;
                                })}
                            </TableRow>
                        );
                    })}
                </TableBody>
                <TableFoot>
                    <TableRow>
                        <TableCell>Cols</TableCell>
                        <TableCell colSpan={colsVisible} className={classes.horizontal}>
                            <Slider
                                defaultValue={1}
                                valueLabelDisplay='auto'
                                min={1}
                                step={1}
                                max={maxCols}
                                value={startCol}
                                onChange={(event: React.ChangeEvent<{}>, index: number | number[]): void => {
                                    onColIndexChange(Number(index));
                                }}
                            />
                        </TableCell>
                    </TableRow>
                    <TableRow>
                        <TableCell>Rows</TableCell>
                        <TableCell colSpan={colsVisible} className={classes.horizontal}>
                            <Slider
                                defaultValue={1}
                                valueLabelDisplay='off'
                                min={1}
                                step={1}
                                max={maxRows}
                                value={startRow}
                                onChange={(event: React.ChangeEvent<{}>, index: number | number[]): void => {
                                    onRowIndexChange(Number(index));
                                }}
                            />
                        </TableCell>
                    </TableRow>
                </TableFoot>
            </Table>
        </TableContainer>
    );
};

export default CalculatedGrid;
