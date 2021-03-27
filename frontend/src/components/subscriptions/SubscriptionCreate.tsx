import React, { ReactElement } from 'react';
import { CheckboxGroupInput, DateInput, ReferenceInput, SelectInput } from 'react-admin';
import { Create, TabbedForm, FormTab } from 'react-admin';
import { UserTypeChoices, PrivledgeChoices } from '../../helper/AppTypes';

const SubscriptionCreate = (props): ReactElement => (
    <Create title='Create a Subscription' {...props}>
        <TabbedForm>
            <FormTab label='Basics'>
                <ReferenceInput label='User' source='user' reference='users' allowEmpty>
                    <SelectInput optionText='username' />
                </ReferenceInput>
                <ReferenceInput label='Trackrecord' source='trackrecord' reference='trackrecords'>
                    <SelectInput optionText='title' />
                </ReferenceInput>

                <SelectInput label='User Type' source='userType' choices={UserTypeChoices} />
                <DateInput label='Starts On' source='startsOn' />
                <DateInput label='Ends On' source='endsOn' allowEmpty />
            </FormTab>
            <FormTab label='Privledges'>
                <CheckboxGroupInput label='Trackrecord' source='trackrecordActions' choices={PrivledgeChoices} />
                <CheckboxGroupInput label='Subscriptions' source='subscriptionActions' choices={PrivledgeChoices} />
                <CheckboxGroupInput label='Pending Orders' source='pendingOrderActions' choices={PrivledgeChoices} />
                <CheckboxGroupInput label='Filled Orders' source='filledOrderActions' choices={PrivledgeChoices} />
                <CheckboxGroupInput label='Open Positions' source='openPositionActions' choices={PrivledgeChoices} />
                <CheckboxGroupInput
                    label='Closed Positions'
                    source='closedPositionActions'
                    choices={PrivledgeChoices}
                />
            </FormTab>
        </TabbedForm>
    </Create>
);

export default SubscriptionCreate;
