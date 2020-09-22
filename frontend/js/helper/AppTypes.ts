import { Record, Identifier } from 'ra-core';

export type UserType = 'owner' | 'admin' | 'subscriber' | 'anomyous';

export type ViewState = 'anomyous' | 'transparent';

export type PrivledgeAction = 'create' | 'view' | 'edit' | 'delete' | 'hidden';

export type JoinStatusAction = 'created' | 'waiting' | 'accepted' | 'rejected';

export const PrivledgeChoices = [
    { id: 'hidden', name: 'Hidden' },
    { id: 'create', name: 'Create' },
    { id: 'edit', name: 'Edit' },
    { id: 'view', name: 'View' },
    { id: 'delete', name: 'Delete' }
];

export const UserTypeChoices = [
    { id: 'owner', name: 'Owner' },
    { id: 'admin', name: 'Admin' },
    { id: 'subscriber', name: 'Subscriber' },
    { id: 'anomyous', name: 'Anomyous' }
];

export const JoinStatusChoices = [
    { id: 'created', name: 'Created' },
    { id: 'waiting', name: 'Waiting' },
    { id: 'rejected', name: 'Rejected' },
    { id: 'accepted', name: 'Accepted' }
];

export const RecipientTypeChoices = [
    { id: 'email', name: 'Email' },
    { id: 'username', name: 'Username' },
    { id: 'sms', name: 'Text Message' },
    { id: 'twitter', name: 'Twitter' },
    { id: 'Facebook', name: 'Facebook' }
];

export interface EntityInterface extends Record {
    created: Date;
    updated: Date;
}

export interface UserTypeInterface {
    userType: UserType;
}

export interface RecipientInterface {
    recipientType: string;
    recipient: string;
}

export interface MessageInterface {
    message: string | null;
}

export interface EmailInterface {
    email: string;
}

export interface UsernameInterface {
    username: string;
}

export interface CodeInterface {
    code: string;
}

export interface TitleInterface {
    title: string;
}

export interface DescriptionInterface {
    description: string;
}

export interface PrivledgesInterface {
    trackrecordActions: PrivledgeAction[];

    subscriptionActions: PrivledgeAction[];

    pendingOrderActions: PrivledgeAction[];

    filledOrderActions: PrivledgeAction[];

    openPositionActions: PrivledgeAction[];

    closedPositionActions: PrivledgeAction[];
}

export interface StartsOnInterface {
    startsOn: Date;
}

export interface EndsOnInterface {
    endsOn: Date | null;
}

export interface MetadataInterface extends EntityInterface, CodeInterface, TitleInterface {}

export interface Exchange extends EntityInterface, MetadataInterface {}

export interface Market extends EntityInterface, MetadataInterface {}

export interface Security extends EntityInterface, MetadataInterface {}

export interface Stock extends EntityInterface, CodeInterface, TitleInterface {
    exchange: Identifier | Exchange;
    market: Identifier | Market;
    security: Identifier | Security;
}

export interface Subscription
    extends EntityInterface,
        PrivledgesInterface,
        StartsOnInterface,
        EndsOnInterface,
        UserTypeInterface {
    user: Identifier | User;

    trackrecord: Identifier | Trackrecord;
}

export interface Invitation extends EntityInterface, RecipientInterface, MessageInterface {}

export interface Trackrecord extends EntityInterface, TitleInterface, DescriptionInterface {}

export interface User extends EntityInterface, EmailInterface, UsernameInterface {
    viewState: ViewState;
}

export interface CalculatedHeaderProps {
    index: number;
    shares: number;
}

export interface CalculatedCellProps {
    initialPrice: number;
    initialCost: number;
    riskPercentage: number;
    range: number;
    warningPercent: number;
    dangerPercent: number;
    initialCapital: number;
    shares: number;
}

export interface CalculatedRowProps {
    index: number;
    initialPrice: number;
    cells: CalculatedCellProps[];
}

export interface CalculatorFieldProps {
    initialCapital: number;
    priceOffset: number;
    riskAmount: number;
    warningPercent: number;
    dangerPercent: number;
    startCol: number;
    increCol: number;
    startRow: number;
    increRow: number;
}

// export interface Category extends Record {
//     name: string;
// }

// export interface Product extends Record {
//     category_id: Identifier;
//     description: string;
//     height: number;
//     image: string;
//     price: number;
//     reference: string;
//     stock: number;
//     thumbnail: string;
//     width: number;
// }

// export interface Customer extends Record {
//     first_name: string;
//     last_name: string;
//     address: string;
//     city: string;
//     zipcode: string;
//     avatar: string;
//     birthday: string;
//     first_seen: string;
//     last_seen: string;
//     has_ordered: boolean;
//     latest_purchase: string;
//     has_newsletter: boolean;
//     groups: string[];
//     nb_commands: number;
//     total_spent: number;
// }

// export type OrderStatus = 'ordered' | 'delivered' | 'cancelled';

// export interface Order extends Record {
//     status: OrderStatus;
//     basket: BasketItem[];
//     date: Date;
//     total: number;
// }

// export interface BasketItem {
//     product_id: Identifier;
//     quantity: number;
// }

// export interface Review extends Record {
//     date: Date;
//     status: ReviewStatus;
//     customer_id: Identifier;
//     product_id: Identifier;
// }
