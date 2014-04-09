/* =============================================================
 * xpertxacrodion.js v1.0
 * http://www.themexpert.com
 * =============================================================
 * Copyright 2010-2012 ThemeXpert
 *
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


jQuery(document).ready( function () {
//Set default open/close settings
    jQuery('.xac-container').hide(); //Hide/close all containers
    jQuery('.xac-trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

    //On Click
    jQuery('.xac-trigger').click(function(){
        if( jQuery(this).next().is(':hidden') ) { //If immediate next container is closed...
            jQuery('.xac-trigger').removeClass('active').next().slideUp(); //Remove all "active" state and slide up the immediate next container
            jQuery(this).toggleClass('active').next().slideDown(); //Add "active" state to clicked trigger and slide down the immediate next container
        }
        else{
            jQuery('.xac-trigger').removeClass('active');
            jQuery(this).next().slideUp();
        }
        return false; //Prevent the browser jump to the link anchor
    });

});