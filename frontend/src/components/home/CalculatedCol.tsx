import React, { ReactElement } from 'react';
import { CalculatedCellProps } from '../../helper/AppTypes';
import TableCell from '@material-ui/core/TableCell';
import { makeStyles } from '@material-ui/core/styles';

const CalculatedCol = ({
    initialPrice,
    initialCost,
    riskPercentage,
    range,
    warningPercent,
    dangerPercent,
    initialCapital,
    onCellClick
}: CalculatedCellProps): ReactElement => {
    const statusMap = {
        header: 'inherit',
        good: 'green',
        warning: 'orange',
        danger: 'red',
        disabled: 'grey'
    };

    let cellStatus = 'good';

    if (warningPercent < riskPercentage && riskPercentage <= dangerPercent) {
        cellStatus = 'warning';
    }

    if (dangerPercent < riskPercentage && initialCost < initialCapital) {
        cellStatus = 'danger';
    }

    if (initialCost >= initialCapital) {
        cellStatus = 'disabled';
    }

    const classes = makeStyles({
        td: {
            backgroundColor: statusMap[cellStatus]
        }
    })();

    const content = range === Infinity ? initialPrice.toFixed(2) : range.toFixed(2);

    return (
        <TableCell
            component='th'
            scope='row'
            align='right'
            className={classes.td}
            onMouseEnter={(): void => onCellClick(initialPrice, initialCost / initialPrice)}
        >
            {content}
        </TableCell>
    );
};

export default CalculatedCol;
