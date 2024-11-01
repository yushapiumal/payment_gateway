<?php
/*
 * Copyright (c) 2013 - 2024 MasterCard International Incorporated
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are 
 * permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of 
 * conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * Neither the name of the MasterCard International Incorporated nor the names of its 
 * contributors may be used to endorse or promote products derived from this software 
 * without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES 
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT 
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING 
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF 
 * SUCH DAMAGE.
 */


class Simplify_Refund extends Simplify_Object {
    /**
     * Creates an Simplify_Refund object
     * @param     array $hash a map of parameters; valid keys are:<dl style="padding-left:10px;">
     *     <dt><tt>amount</tt></dt>    <dd>Amount of the refund in the smallest unit of your currency. Example: 100 = $1.00 <strong>required </strong></dd>
     *     <dt><tt>payment</tt></dt>    <dd>ID of the payment for the refund </dd>
     *     <dt><tt>reason</tt></dt>    <dd>Reason for the refund </dd>
     *     <dt><tt>reference</tt></dt>    <dd>Custom reference field to be used with outside systems. </dd>
     *     <dt><tt>replayId</tt></dt>    <dd>An identifier that can be sent to uniquely identify a refund request to facilitate retries due to I/O related issues. This identifier must be unique for your account (sandbox or live) across all of your refunds. If supplied, we will check for a refund on your account that matches this identifier. If found we will return an identical response to that of the original request. [max length: 50, min length: 1] </dd>
     *     <dt><tt>statementDescription.name</tt></dt>    <dd>Merchant name. <strong>required </strong></dd>
     *     <dt><tt>statementDescription.phoneNumber</tt></dt>    <dd>Merchant contact phone number. </dd></dl>
     * @param     $authentication -  information used for the API call.  If no value is passed the global keys Simplify::public_key and Simplify::private_key are used.  <i>For backwards compatibility the public and private keys may be passed instead of the authentication object.<i/>
     * @return    Refund a Refund object.
     */
    static public function createRefund($hash, $authentication = null) {

        $args = func_get_args();
        $authentication = Simplify_PaymentsApi::buildAuthenticationObject($authentication, $args, 2);

        $instance = new Simplify_Refund();
        $instance->setAll($hash);

        $object = Simplify_PaymentsApi::createObject($instance, $authentication);
        return $object;
    }



       /**
        * Retrieve Simplify_Refund objects.
        * @param     array criteria a map of parameters; valid keys are:<dl style="padding-left:10px;">
        *     <dt><tt>filter</tt></dt>    <dd><table class="filter_list"><tr><td>filter.id</td><td>Filter by the refund Id</td></tr><tr><td>filter.text</td><td>Filter by the refund description text</td></tr><tr><td>filter.replayId</td><td>Filter by the compoundReplayId</td></tr><tr><td>filter.authCode</td><td>Filter by the authorization code (Not authorization ID)</td></tr><tr><td>filter.amount</td><td>Filter by the refund amount (in the smallest unit of your currency)</td></tr><tr><td>filter.dateCreatedMin<sup>*</sup></td><td>Filter by the minimum created date you are searching for - Date in UTC millis</td></tr><tr><td>filter.dateCreatedMax<sup>*</sup></td><td>Filter by the maximum created date you are searching for - Date in UTC millis</td></tr><tr><td>filter.deposit</td><td>Filter by the deposit id</td></tr><tr><td>filter.q</td><td>You can use this to filter by the Id, the authCode or the amount of the refund</td></tr></table><br><sup>*</sup>Use dateCreatedMin with dateCreatedMax in the same filter if you want to search between two created dates  </dd>
        *     <dt><tt>max</tt></dt>    <dd>Allows up to a max of 50 list items to return. [min value: 0, max value: 50, default: 20]  </dd>
        *     <dt><tt>offset</tt></dt>    <dd>Used in paging of the list.  This is the start offset of the page. [min value: 0, default: 0]  </dd>
        *     <dt><tt>sorting</tt></dt>    <dd>Allows for ascending or descending sorting of the list.  The value maps properties to the sort direction (either <tt>asc</tt> for ascending or <tt>desc</tt> for descending).  Sortable properties are: <tt> id</tt><tt> amount</tt><tt> description</tt><tt> dateCreated</tt><tt> paymentDate</tt>.</dd></dl>
        * @param     $authentication -  information used for the API call.  If no value is passed the global keys Simplify::public_key and Simplify::private_key are used.  <i>For backwards compatibility the public and private keys may be passed instead of the authentication object.</i>
        * @return    ResourceList a ResourceList object that holds the list of Refund objects and the total
        *            number of Refund objects available for the given criteria.
        * @see       ResourceList
        */
        static public function listRefund($criteria = null, $authentication = null) {

            $args = func_get_args();
            $authentication = Simplify_PaymentsApi::buildAuthenticationObject($authentication, $args, 2);

            $val = new Simplify_Refund();
            $list = Simplify_PaymentsApi::listObject($val, $criteria, $authentication);

            return $list;
        }


        /**
         * Retrieve a Simplify_Refund object from the API
         *
         * @param     string id  the id of the Refund object to retrieve
         * @param     $authentication -  information used for the API call.  If no value is passed the global keys Simplify::public_key and Simplify::private_key are used.  <i>For backwards compatibility the public and private keys may be passed instead of the authentication object.</i>
         * @return    Refund a Refund object
         */
        static public function findRefund($id, $authentication = null) {

            $args = func_get_args();
            $authentication = Simplify_PaymentsApi::buildAuthenticationObject($authentication, $args, 2);

            $val = new Simplify_Refund();
            $val->id = $id;

            $obj = Simplify_PaymentsApi::findObject($val, $authentication);

            return $obj;
        }

    /**
     * @ignore
     */
    public function getClazz() {
        return "Refund";
    }
}