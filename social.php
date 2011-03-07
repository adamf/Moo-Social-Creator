<html>
 <head>
  <title>MOO Social Creator</title>
 </head>
 <body>

    <?php 

	 $socialname = (empty($_POST['socialname'])) ? '' : htmlspecialchars($_POST['socialname']);

	 $alone = (empty($_POST['alone'])) ? 'You %v.' : htmlspecialchars($_POST['alone']);
	 $aloneroom = (empty($_POST['aloneroom'])) ? '%n %vs.' : htmlspecialchars($_POST['aloneroom']);
	 $victimplayer = (empty($_POST['victimplayer'])) ? 'You %v %d.' : htmlspecialchars($_POST['victimplayer']);
	 $victim = (empty($_POST['victim'])) ? '%n %vs you.' : htmlspecialchars($_POST['victim']);
	 $victimroom = (empty($_POST['victimroom'])) ? '%n %vs %d.' : htmlspecialchars($_POST['victimroom']);
	 $selfplayer = (empty($_POST['selfplayer'])) ? 'You %v yourself.' : htmlspecialchars($_POST['selfplayer']);
	 $selfroom = (empty($_POST['selfroom'])) ? '%n %vs %r.' : htmlspecialchars($_POST['selfroom']);

#<!--
#
#@addsocial <socialName> with {"bla", "bla", "bla", "bla", "bla", "bla", 
#"bla"}
#
#Value:        {"You open your arms wide, begging the populace to embrace 
#you.", "%n extends %p arms, apparently wanting a hug.", "You hug %d.", "%n 
#hugs you.", "%n hugs %d warmly.", "You pull your arms around your body.", "%n 
##hugs %r.", #2, #2}
#-->

	if (strlen($_POST['alone']) and 
	      strlen($_POST['aloneroom']) and
	      strlen($_POST['victimplayer']) and
	      strlen($_POST['victim']) and
	      strlen($_POST['victimroom']) and
	      strlen($_POST['selfroom']) and
	      strlen($_POST['socialname']) and
	      strlen($_POST['selfplayer'])) {

	     $nounmeta = "%v";
	     $alone = str_replace($nounmeta, $socialname, $alone); 
	     $aloneroom = str_replace($nounmeta, $socialname, $aloneroom); 
	     $victim = str_replace($nounmeta, $socialname, $victim); 
	     $victimplayer = str_replace($nounmeta, $socialname, $victimplayer); 
	     $selfroom = str_replace($nounmeta, $socialname, $selfroom); 
	     $selfplayer = str_replace($nounmeta, $socialname, $selfplayer); 

	     echo "Copy and paste this into tf to add a social:\n";
	     echo "<pre>";
	     echo '@addsocial ' . $socialname . ' with {"' .  $alone . '",  "' . $aloneroom . '", "' . $victimplayer . '", "' . $victim . '", "' . $victimroom . '", "' . $selfplayer . '", "' . $selfroom . '"}';
	     echo "</pre>";
	     echo "Copy and paste this into tf to edit a social:\n";
	     echo "<pre>";
	     echo '@editsocial ' . $socialname . ' with {"' .  $alone . '",  "' . $aloneroom . '", "' . $victimplayer . '", "' . $victim . '", "' . $victimroom . '", "' . $selfplayer . '", "' . $selfroom . '"}';
	     echo "</pre>";
	    }
	    echo '
 <form action="social.php" method="post">
    <table>
	<tbody>
	    <tr>
		<td valign="top" align="right" width="20%">
		 Social Name:
		</td>
		<td align="left" width="80%">
		    <input type="text" name="socialname"/>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
		 Told to player when used alone:
		</td>
		<td align="left" width="80%">
		    <textarea rows="3"  cols="40" name="alone" >' . $alone . '</textarea>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
 Announced to room when used alone:
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="aloneroom" >'. $aloneroom . '</textarea>
		</td>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
 Told to player when used with victim:
		</td>
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="victimplayer" >' . $victimplayer . '</textarea>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
 Told to victim:
		</td>
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="victim" >' . $victim . '</textarea>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
Announced to room when used with victim:
		</td>
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="victimroom" >' . $victimroom . '</textarea>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
 <p>Announced to player when used on self:
		</td>
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="selfplayer" >' . $selfplayer . '</textarea>
		</td>
	    </tr>
	    <tr>
		<td valign="top" align="right" width="20%">
 <p>Announced to room when used on self:
		</td>
		<td align="left" width="80%">
 <textarea rows="3" cols="40" name="selfroom" >' .  $selfroom . '</textarea>
		</td>
	    </tr>'
    ?>
	</tbody>
    </table>
 <input type="submit" value="Click to show moo code"/></p>
</form>

 <pre>

Simple metacharacters for automatic string replacement:
    Verbs:
        %v => the social name ("hug", "punch", etc.)
    Special:
        %% => `%'  (just in case you actually want to talk about percentages).
    Names:
        %n => the player
        %t => this object (i.e., the object issuing the message,... usually)
        %d => the direct object from the command line
        %i => the indirect object from the command line
        %l => the location of the player
    Pronouns:
        %s => subject pronoun:          either `he',  `she', or `it'
        %o => object pronoun:           either `him', `her', or `it'
        %p => posessive pronoun (adj):  either `his', `her', or `its'  
        %q => posessive pronoun (noun): either `his', `hers', or `its'

In addition there is a set of capitalized substitutions for use at the 
beginning of sentences.  These are, respectively, 

   %N, %T, %D, %I, %L for object names, 
   %S, %O, %P, %Q, %R for pronouns, and
   %(Foo), %[dFoo] (== %[Dfoo] == %[DFoo]),... for general properties

Note: there is a special exception for player .name's which are assumed to
already be capitalized as desired.

There may be situations where the standard algorithm, i.e., upcasing the first 
letter, yields something incorrect, in which case a "capitalization" for a 
particular string property can be specified explicitly.  If your object has a 
".foo" property that is like this, you need merely add a ".fooc" (in general 
.(propertyname+"c")) specifying the correct capitalization.  This will also 
work for player .name's if you want to specify a capitalization that is 
different from your usual .name

Example:  
Rog makes a hand-grenade with a customizable explode message.
Suppose someone sets grenade.explode_msg to:

  "%N(%#) drops %t on %p foot.  %T explodes.  
   %L is engulfed in flames."

If the current location happens to be #3443 ("yduJ's Hairdressing Salon"),
the resulting substitution may produce, eg.,

  "Rog(#4292) drops grenade on his foot.  Grenade explodes.  
   YduJ's Hairdressing Salon is engulfed in flames."

which contains an incorrect capitalization.  
yduJ may remedy this by setting #3443.namec="yduJ's Hairdressing Salon".

 </pre>

 </body>
</html>


