<div class="container home-block">
   <div class="profile">
      <div class="row">
         <div class="col-md-3 md-margin-bottom-40">
         <?php $this->load->view('_partials/user_menu'); ?>
         </div>
         <div class="col-md-9">
            <div class="profile-body">
               <div class="tab-v1">
                  <ul class="nav nav-justified nav-tabs">
                     <li class="active"><a href="javascript:;">Edit Profile</a></li>
                     <li><a href="/account/change_password">Change Password</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="profile" class="profile-edit tab-pane fade active in">
                        <h2 class="heading-md">Manage personal information for your account.</h2>
                        <p>To change your primary email address or your name, please contact us through email.</p>
                        <br>
						
                        <form action="/account/profile" method="post" autocomplete="off" class="sky-form" id="sky-form4">
						<?php echo $form->messages(); ?>
						<dl class="dl-horizontal">
                              <dt>Email</dt>
                              <dd>
                                 <section>
                                    <label class="input state-disabled">
                                    <input name="email" type="text" disabled="disabled" value="<?php echo ($data["email"]);?>">                                            			      </label>
                                 </section>
                              </dd>
                              <dt>First Name</dt>
                              <dd>
                                 <section>
                                    <label class="input state-disabled">
                                    <input type="text" name="firstName" disabled="disabled" value="<?php echo ($data["first_name"]);?>">                                            				</label>
                                 </section>
                              </dd>
                              <dt>Last Name</dt>
                              <dd>
                                 <section>
                                    <label class="input state-disabled">
                                    <input type="text" name="lastName" disabled="disabled" value="<?php echo ($data["last_name"]);?>">                                            			      </label>
                                 </section>
                              </dd>
                              <dt>Badge #</dt>
                              <dd>
                                 <section>
                                    <label class="input state-disabled">
                                    <input type="text" name="badge" disabled="disabled" value="<?php echo ($data["badge"]);?>">                                            			     </label>
                                 </section>
                              </dd>
                              <dt>Address Line 1</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="addressLine1" placeholder="Address Line 1" value="<?php echo ($data["home_address_1"]);?>">                                            				 </label>
                                 </section>
                              </dd>
                              <dt>Address Line 2</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="addressLine2" placeholder="Address Line 2" value="<?php echo ($data["home_address_2"]);?>">                                            				 </label>
                                    <div class="note">Optional (example: PO Box, Apt #)</div>
                                 </section>
                              </dd>
                              <dt>City</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="city" placeholder="City" value="<?php echo ($data["home_city"]);?>">                                            			       </label>
                                 </section>
                              </dd>
                              <dt>State</dt>
                              <dd>
                                 <section>
                                    <label class="select">
                                       <select name="addressState" id="addressState">
                                          <option value=""></option>
                                          <option value="AL">Alabama</option>
                                          <option value="AK">Alaska</option>
                                          <option value="AZ">Arizona</option>
                                          <option value="AR">Arkansas</option>
                                          <option value="CA">California</option>
                                          <option value="CO">Colorado</option>
                                          <option value="CT">Connecticut</option>
                                          <option value="DE">Delaware</option>
                                          <option value="DC">District of Columbia</option>
                                          <option value="FL">Florida</option>
                                          <option value="GA">Georgia</option>
                                          <option value="HI">Hawaii</option>
                                          <option value="ID">Idaho</option>
                                          <option value="IL">Illinois</option>
                                          <option value="IN">Indiana</option>
                                          <option value="IA">Iowa</option>
                                          <option value="KS">Kansas</option>
                                          <option value="KY">Kentucky</option>
                                          <option value="LA">Louisiana</option>
                                          <option value="ME">Maine</option>
                                          <option value="MD">Maryland</option>
                                          <option value="MA">Massachusetts</option>
                                          <option value="MI">Michigan</option>
                                          <option value="MN">Minnesota</option>
                                          <option value="MS">Mississippi</option>
                                          <option value="MO">Missouri</option>
                                          <option value="MT">Montana</option>
                                          <option value="NE">Nebraska</option>
                                          <option value="NV">Nevada</option>
                                          <option value="NH">New Hampshire</option>
                                          <option value="NJ">New Jersey</option>
                                          <option value="NM">New Mexico</option>
                                          <option value="NY">New York</option>
                                          <option value="NC">North Carolina</option>
                                          <option value="ND">North Dakota</option>
                                          <option value="OH">Ohio</option>
                                          <option value="OK">Oklahoma</option>
                                          <option value="OR">Oregon</option>
                                          <option value="PA">Pennsylvania</option>
                                          <option value="RI">Rhode Island</option>
                                          <option value="SC">South Carolina</option>
                                          <option value="SD">South Dakota</option>
                                          <option value="TN">Tennessee</option>
                                          <option value="TX">Texas</option>
                                          <option value="UT">Utah</option>
                                          <option value="VT">Vermont</option>
                                          <option value="VA">Virginia</option>
                                          <option value="WA">Washington</option>
                                          <option value="WV">West Virginia</option>
                                          <option value="WI">Wisconsin</option>
                                          <option value="WY">Wyoming</option>
                                       </select>
                                       <i></i>
                                    </label>
                                 </section>
                              </dd>
                              <dt>Zip Code</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="zipCode" placeholder="Zip Code" value="<?php echo ($data["home_zipcode"]);?>">                                            			      </label>
                                 </section>
                              </dd>
                              <dt>Phone</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo ($data["phone"]);?>">                                            			    </label>
                                 </section>
                              </dd>
                              <dt>Cell Phone</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="cellPhone" id="cellPhone" placeholder="Cell Phone" value="<?php echo ($data["cell_phone"]);?>">                                            			      </label>
                                 </section>
                              </dd>
                              <dt>Secondary Email</dt>
                              <dd>
                                 <section>
                                    <label class="input">
                                    <input type="text" name="secondaryEmail" placeholder="Secondary Email" value="<?php echo ($data["secondary_email"]);?>">                                            			    </label>
                                 </section>
                              </dd>
                           </dl>
                           <input type="hidden" name="userId" value="<?php echo ($data["user_id"]);?>">
                           <hr>
                           <button class="btn-u" type="submit">Save Changes</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script type="text/javascript">
	   $('#addressState').val('<?php echo ($data["home_state"]);?>');
	</script>
</div>
