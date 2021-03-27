import React, { ReactElement, useState } from 'react';
import { CalculatorFieldProps, CalculatedRowProps, CalculatedCellProps } from '../../helper/AppTypes';
import CalculatedCol from './CalculatedCol';
import { makeStyles } from '@material-ui/core/styles';
import Slider from '@material-ui/core/Slider';

interface CalculatforGridProps extends CalculatorFieldProps {
    onColIndexChange: (index: number) => void;
    onRowIndexChange: (index: number) => void;
    onCellClick: (column: number, row: number) => void;
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
    onRowIndexChange,
    onCellClick
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
        },
        th: {
            textAlign: 'center'
        }
    })();

    const [colsVisible, setColsVisible] = useState(17);

    const [rowsVisible, setRowVisible] = useState(20);

    const maxCols = initialCapital / increCol - colsVisible + 1;

    const maxRows = initialCapital / increRow / increCol - rowsVisible + 1;

    const headers = Array.from({ length: colsVisible }, (_, col) => col).map(function (col) {
        return {
            index: col + startCol,
            shares: (col + startCol) * increCol
        };
    });

    const data = Array.from({ length: rowsVisible }, (_, row) => row).map(function (row): CalculatedRowProps {
        const initialPrice = Number((startRow + row * increRow + priceOffset).toFixed(2));
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
                shares: col.shares,
                onCellClick: onCellClick
            };
        });

        return {
            index: row,
            initialPrice: initialPrice,
            cells: cells
        };
    });

    return (
        <table className={classes.table}>
            <thead>
                <tr>
                    <th>Price</th>
                    {headers.map(function (item) {
                        return <th key={item.index}>{item.shares}</th>;
                    })}
                    <th>&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {data.map(function (record): ReactElement {
                    return (
                        <tr key={`row: ${record.initialPrice}`}>
                            <td>{record.initialPrice}</td>
                            {record.cells.map(function (cell) {
                                return <CalculatedCol key={`${record.initialPrice}, ${cell.shares}`} {...cell} />;
                            })}
                        </tr>
                    );
                })}
            </tbody>
            <tfoot>
                <tr>
                    <td>Cols</td>
                    <td colSpan={colsVisible} className={classes.horizontal}>
                        <Slider
                            defaultValue={1}
                            valueLabelDisplay='auto'
                            min={1}
                            step={1}
                            max={maxCols}
                            value={typeof startCol === 'number' ? startCol : 1}
                            onChange={(event: React.ChangeEvent<{}>, index: number | number[]): void => {
                                onColIndexChange(Number(index));
                            }}
                        />
                    </td>
                </tr>
                <tr>
                    <td>Rows</td>
                    <td colSpan={colsVisible} className={classes.horizontal}>
                        <Slider
                            defaultValue={1}
                            min={1}
                            step={1}
                            max={maxRows}
                            valueLabelDisplay='auto'
                            value={typeof startRow === 'number' ? startRow : 1}
                            onChange={(event: React.ChangeEvent<{}>, index: number | number[]): void => {
                                onRowIndexChange(Number(index));
                            }}
                        />
                    </td>
                </tr>
            </tfoot>
        </table>
    );
};

export default CalculatedGrid;
