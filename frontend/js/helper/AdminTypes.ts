import { ReactChildren } from 'react';
import { ReduxState } from 'ra-core';
import { useListController, Record, Identifier, usePermissions, RedirectionSideEffect } from 'ra-core';
import { RouteComponentProps } from 'react-router-dom';
import { StaticContext } from 'react-router';
import * as H from 'history';
import { ClassNameMap } from '@material-ui/core/styles/withStyles';
import { ListControllerProps } from 'ra-core/esm/controller/useListController';
import { FormRenderProps } from 'react-final-form';

export type ThemeName = 'light' | 'dark';

export interface AppState extends ReduxState {
    theme: ThemeName;
}

/**
 * Types to eventually add in react-admin
 */
export interface FieldProps<T extends Record = Record> {
    addLabel?: boolean;
    label?: string;
    record?: T;
    source?: string;
    resource?: string;
    basePath?: string;
    formClassName?: string;
}

export interface ReferenceFieldProps<T extends Record = Record> extends FieldProps<T> {
    reference: string;
    children: ReactChildren;
    link?: string | false;
    sortBy?: string;
}

export interface ResourceMatch {
    id: string;
    [k: string]: string;
}

type FilterClassKey = 'button' | 'form';

export interface ToolbarProps<T extends Record = Record> {
    handleSubmitWithRedirect?: (redirect: RedirectionSideEffect) => void;
    handleSubmit?: FormRenderProps['handleSubmit'];
    invalid?: boolean;
    pristine?: boolean;
    saving?: boolean;
    submitOnEnter?: boolean;
    redirect?: RedirectionSideEffect;
    basePath?: string;
    record?: T;
    resource?: string;
    undoable?: boolean;
}

export interface BulkActionProps<Params = {}> {
    basePath?: string;
    filterValues?: Params;
    resource?: string;
    selectedIds?: Identifier[];
}

export interface FilterProps<Params = {}> {
    classes?: ClassNameMap<FilterClassKey>;
    context?: 'form' | 'button';
    displayedFilters?: { [K in keyof Params]?: boolean };
    filterValues?: Params;
    hideFilter?: ReturnType<typeof useListController>['hideFilter'];
    setFilters?: ReturnType<typeof useListController>['setFilters'];
    showFilter?: ReturnType<typeof useListController>['showFilter'];
    resource?: string;
}

export interface DatagridProps<RecordType = Record> extends Partial<ListControllerProps<RecordType>> {
    hasBulkActions?: boolean;
}

export interface ResourceComponentProps<
    Params extends { [K in keyof Params]?: string } = {},
    C extends StaticContext = StaticContext,
    S = H.LocationState
> extends RouteComponentProps<Params, C, S> {
    resource: string;
    options: object;
    hasList: boolean;
    hasEdit: boolean;
    hasShow: boolean;
    hasCreate: boolean;
    permissions: ReturnType<typeof usePermissions>['permissions'];
}

export type ListComponentProps<Params = {}> = ResourceComponentProps<Params>;

export interface EditComponentProps<
    Params extends ResourceMatch = { id: string },
    C extends StaticContext = StaticContext,
    S = H.LocationState
> extends ResourceComponentProps<Params, C, S> {
    id: string;
}

export interface ShowComponentProps<
    Params extends ResourceMatch = { id: string },
    C extends StaticContext = StaticContext,
    S = H.LocationState
> extends ResourceComponentProps<Params, C, S> {
    id: string;
}

export interface CreateComponentProps<
    Params extends ResourceMatch = { id: string },
    C extends StaticContext = StaticContext,
    S = H.LocationState
> extends ResourceComponentProps<Params, C, S> {
    id: string;
}

// declare global {
//     interface Window {
//         restServer: any;
//     }
// }
