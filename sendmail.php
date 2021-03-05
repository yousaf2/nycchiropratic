<?php
require 'PHPMailerAutoload.php';
require('fpdf.php');
$issuecounter = 1;
error_reporting(0);
$name = $_POST["name"];
$date = $_POST["date"];
$maddress = $_POST["maddress"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$emaddress = $_POST["emaddress"];
$homenr = $_POST["homenr"];
$cellnr = $_POST["cellnr"];
$worknr = $_POST["worknr"];
$call_at_work = $_POST["workcall"];
$contactpreference = "none";
$contactpreference = implode(', ', $_POST['contactpreference']);
$bdate = $_POST["bdate"];
$secnr = $_POST["secnr"];
$gender = $_POST["gender"];
$status = $_POST["status"];
$occuputation = $_POST["occup"];
$employer = $_POST["emp"];
$empaddress = $_POST["empaddress"];
$phonenr = $_POST["phonenr"];
$emergname = $_POST["emergname"];
$emergrelation = $_POST["emergrel"];
$emergphone = $_POST["emergphone"];
$reference = $_POST["ref"];
$Name_of_person_responsible_for_this_account = $_POST["ahn"];
$Relationship_to_patient = $_POST["rtp"];
$new_section_phone = $_POST["nsp"];
$Name_of_Policy_Holder  = $_POST["nph"];
$Date_of_Birth_of_Policy_Holder = $_POST["dobph"];
$Do_you_have_a_Secondary_Insurance   = $_POST["hsi"];
$Name_of_Carrier = $_POST["noc"];
$Are_you_enrolled_in_a  = $_POST["ei1"];
$Name_of_Card_Holder      = $_POST["noch"];
$Card_Type    = $_POST["ct"];
$Exp_Date = $_POST["ced"];
$Credit_Card  = $_POST["ccn"];
$CVV = $_POST["ccv"];

$clientinfo = array(
	$name,
	$date,
	$maddress,
	$city,
	$state,
	$zip,
	$emaddress,
	$homenr,
	$cellnr,
	$worknr,
	$call_at_work,
	$contactpreference,
	$bdate,
	$secnr,
	$gender,
	$status,
	$occuputation,
	$employer,
	$empaddress,
	$phonenr,
	$emergname,
	$emergrelation,
	$emergphone,
	$reference);

	$in_text = 'It is the sole responsibility of the patient to make sure that their insurance policy is effective, which is primary and which is secondary if applicable and to inform us of any and all insurance plans and/or changes; insurance policies are an arrangement between the insurance carrier and the patient. Failure to do so will result in the patient being billed for any outstanding claims or money recoveries requests.

	After the verification of your coverage & deductibles and/or copays this office may accept assignment on most policies provided the insured/patient signs and appropriate statement of benefits and/or a lien authorizing payment to be sent to the doctor. Any medical or other records or information necessary to process any claims will be released from our office. If you have any questions concerning this or any other matter, please speak with the new patient coordinator.If you are unable to make your appointment due to an emergency, please call us and let us know so we can reschedule your appointment. If you need to change the time of your appointment, plan to come another time on the same day. If the same day is not possible, try to make up the missed appointment within one week as not to disrupt your treatment plan. With the exception of an unexpected emergency, we require that you notify us 6 hours in advance as to any appointment changes to avoid being charged.

For no call/no show appointments or cancellations less than 6 hours in advance, there is a non-refundable $50.00 service charge that will be billed to you or your credit card/debit card on file.

I authorize this medical practice to process the above credit card as “card on file”. I understand this authorization will remain in effect until the expiration of the credit card account; patient may also revoke this form by submitting a written request to the medical practice.
	';
$insurance_info = array(
	$Name_of_person_responsible_for_this_account,
	$Relationship_to_patient,
	$new_section_phone,
	$Name_of_Policy_Holder,
	$Date_of_Birth_of_Policy_Holder,
	$Do_you_have_a_Secondary_Insurance,
	$Name_of_Carrier,
	$Are_you_enrolled_in_a,
	$Name_of_Card_Holder,
	$Card_Type,
	$Exp_Date,
	$Credit_Card,
	$CVV,
	$in_text
);

$insurance_info_question = array(
	"Name of person responsible for this account",
	"Relationship to patient (if other than self)",
	"Phone",
	"Name of Policy Holder",
	"Date of Birth of Policy Holder",
	"Do you have a Secondary Insurance",
	"Name of Carrier",
	"Are you enrolled in a",
	"Name of Card Holder",
	"Card Type",
	"Exp Date",
	"Credit Card #",
	"CVV Code (3 or 4 digit #)"
);

$clientquestions = array(
	"Name",
	"Date",
	"Mailing Address",
	"City",
	"State",
	"Zip",
	"Email Address",
	"Home #",
	"Cell #",
	"Work #",
	"Can we call you at work?",
	"Do you prefer to have appointments confirmed by",
	"Date of Birth (mm/dd/yyyy)",
	"Social Security #",
	"Sex",
	"Marital Status",
	"Occupation",
	"Employer",
	"Employer Address",
	"Phone #",
	"Emergency person name",
	"Emergency person relation",
	"Emergency phone #",
	"How did you hear about our practice?");


$answers = array(
	$_POST["one"],
	$_POST["two"],
	manageIssues("cause", true) . ": " . $_POST["otherexp1"],
	'.',
	$_POST["fivedays"] . " days " . $_POST["fiveweeks"] . " weeks " . $_POST["fivemonths"] . " months " . $_POST["fiveyears"] . " years",
	$_POST["often"],
	manageIssues("describe", true) . ": " . $_POST["otherexp2"],
	$_POST["changing"],
	$_POST["scale"],
	manageIssues("else", true) . ": " . $_POST["otherexp3"],
	$_POST["severe"],
	$_POST["whatbetter"],
	$_POST["whatworse"],
	$_POST["height"] . " ft/inch " . $_POST["weight"] . " lbs. " . $_POST["age"] . " years",
	$_POST["health"],
	$_POST["typeexc"],
	$_POST["caffeine"] . " cups/day " . $_POST["alcohol"] . " drinks/wk " . $_POST["cigarets"] . " packs/day",
	manageIssues("disease", true) . ": " . $_POST["otherexp4"],
	"Headaches: " . manageIssues("issue1") . ", " . "Neck Pain: " . manageIssues("issue2") . ", " . "Upper Back Pain: " . manageIssues("issue3") . "\n" . "Mid Back Pain: " . manageIssues("issue4") . ", " . "Low Back Pain: " . manageIssues("issue5") . ", " . "Shoulder Pain: " . manageIssues("issue5") . "\n" . "Elbow/Upper Arm Pain: " . manageIssues("issue6") . ", " . "Wrist Pain: " . manageIssues("issue7") . ", " . "Hand Pain: " . manageIssues("issue8") . "\n " . "Hip Pain: " . manageIssues("issue9") . ", " . "Upper Leg Pain: " . manageIssues("issue10") . ", " . "Knee Pain: " . manageIssues("issue11") . "\n" . "Ankle/Foot Pain: " . manageIssues("issue12") . ", " . "Jaw Pain: " . manageIssues("issue13") . ", " . "Joint Pain/Stiffness: " . manageIssues("issue14") . "\n" . "Muscular Incoordination: " . manageIssues("issue15") . ", " . "Arthritis: " . manageIssues("issue16") . ", " . "Rheumatoid Arthritis: " . manageIssues("issue17") . "\n" . "Systemic Lupu: " . manageIssues("issue18") . ", " . "Cancer: " . manageIssues("issue19") . ", " . "Tumor: " . manageIssues("issue20") . "\n" . "Epilepsy: " . manageIssues("issue21") . ", " . "Visual Disturbances: " . manageIssues("issue22") . ", " . "Stroke: " . manageIssues("issue23") . "\n" . "Dizziness: " . manageIssues("issue24") . ", " . "High Blood Pressure: " . manageIssues("issue25") . ", " . "Heart Attack: " . manageIssues("issue26") . "\n" . "Chest Pain: " . manageIssues("issue27") . ", " . "Angina: " . manageIssues("issue28") . ", " . "Hepatitis: " . manageIssues("issue29") . "\n" . "Liver/Gall Bladder Disorder: " . manageIssues("issue30") . ", " . "Abdominal Pain: " . manageIssues("issue31") . ", " . "Uleer: " . manageIssues("issue32") . "\n" . "Kidney Stones: " . manageIssues("issue33") . ", " . "Kidney Disorders: " . manageIssues("issue34") . ", " . "Bladder Infection: " . manageIssues("issue35") . "\n" . "Painful Urination: " . manageIssues("issue36") . ", " . "Loss of Bladder Control: " . manageIssues("issue37") . ", " . "Allergies: " . manageIssues("issue38") . "\n" . "Chronic Simusitis: " . manageIssues("issue39") . ", " . "Dermatitis/Eezema/Rash: " . manageIssues("issue40") . ", " . "Excessive Thrist: " . manageIssues("issue41") . "\n" . "Frequent Urination: " . manageIssues("issue42") . ", " . "Abnormal Weight Gain: " . manageIssues("issue43") . ", " . "Loss of Appetite: " . manageIssues("issue44") . "\n" . "General Fatigue: " . manageIssues("issue45") . ", " . "Smoking/Tobacco Use: " . manageIssues("issue46") . ", " . "Drug/Alcohol Dependence: " . manageIssues("issue47") . "\n" . "Depression: " . manageIssues("issue48") . ", " . "HIV/AIDS: " . manageIssues("issue49") . ", " . "Diabetes: " . manageIssues("issue50") . "\n" . "Asthma: " . manageIssues("issue51") . ", " . "Birth Control Pills: " . manageIssues("issue52") . ", " . "Hormonal Replacement: " . manageIssues("issue53") . "\n" . "Pregnancy: " . manageIssues("issue54") . ", " . "Prostate Problem: " . manageIssues("issue55") . ", " . "Other: " . $_POST["otherexp5"] . " " . manageIssues("issue56"),
	$_POST["currentlytaking"],
	$_POST["allergicto"],
	$_POST["surgicalproc"],
	$_POST["pasttrauma"],
	"Sit: " . $_POST["sit"] . ", " . "Stand: " . $_POST["stand"] . ", " . "Computer work: " . $_POST["computerwork"] . ", " . "On the phone: " . $_POST["onphone"] . ", " . "Other: " . $_POST["otherexp6"] . " " . $_POST["otheract"],
	manageIssues("concern", true),
	$_POST["interfered"],
	$_POST["suffer"],
	$_POST["weaknessm"],
	$_POST["handsleep"],
	$_POST["reducedfeeling"],
	$_POST["sufferhand"],
	$_POST["sufferback"],
	$_POST["weaknesslegs"],
	$_POST["legsleep"],
	$_POST["reducedlegs"],
	$_POST["coldhands"],
	$_POST["triedbefore"] . ": " . $_POST["explanation1"],
	$_POST["triedbeforechiro"] . ": " . $_POST["explanation2"],
	$_POST["mribefore"] . ": " . $_POST["explanation3"],
	$_POST["xraysbefore"] . ": " . $_POST["explanation4"],
	$_POST["bracesbefore"] . ": " . $_POST["explanation5"],
	$_POST["anythingexpected"],
	"I, certify that I (or my dependent) have insurance coverage with " . $_POST["whomstve"] . " and I AUTHORIZE, REQUEST AND ASSIGN MY INSURANCE COMPANY TO PAY DIRECTLY TO THE PHYSICAL/MEDICAL PRACTICE INSURANCE BENEFITS OTHERWISE PAYBALE TO ME. I undderstand that I am financially responsible for all charges whether or not paid by insurace. I hereby authorized the doctor to release all information necessary, including diagnosis and the records of any exam or treatment rendered to me, in order to secure the payment of benefits. I authorize the use of this signature on all insurance claims, including electronic submissions. 
	
	I also understand that my insurance company may be mailing checks payable to me or the insurance subscriber for services rendered. If this should occur I agree that I will sign and bring all check(s) {along with explanations of benefits and/or all documents attached to said check(s)} to the office within 7 days. I am also aware that failure to do so will result in my account being forwarded to the collection department of our attorneys, Kirschenbaum & Kirschenbaum, making me liable for all account balances, attorneys, and court fees.

	--Consent to Care-- 
	A patient coming to the doctor gives his/her permission and authority to care for them in accordance with the appropriate tests, diagnosis and analysis. The clinical procedures performed are usually beneficial and seldom cause any problem. In rare cases, underlying physical defects, deformities or pat or pathologies may render the patient susceptible to injury. The doctor, of course, will not provide specific healthcare if he/she is aware that such care may be contraindicated. It is the responsibilty of the patient to make it known or to learn through healthcare procedures from whatever he/she is suffering from: latent pathological defects, illnesses or deformities which would otherwise not come to the attention of the physican. I affirm that I am not an agent or representative of any insurance ocompany or any other business trying to collect information. All injuries/problems mentioned are true and I am here solely for the treatment of the said problem.");

$questions = array(
	"1. What is your chief complaint?",
	"2. How do you think your problem began?",
	"3. Is today's problem caused by an:",
	"4. Indicate on the drawings below where you have pain/symptoms
	(appear a red circle on the location by clicking on it):",
	"5. How long have you had this problem?",
	"6. How often do you experience your symptomps?",
	"7. How would you describe the pain?",
	"8. How are your symptoms changing with time?",
	"9. Using a scale from 0-10 (10 being the worst), how would you rate your problem?",
	"10. Who else have you seen for your problem?",
	"11. Do you consider this problem to be severe?",
	"12. What makes your problem better?",
	"13. What makes your problem worse?",
	"14. What is your:",
	"15. How would you rate your overall Health?",
	"16. What type of exercise do you do?",
	"17. What is your daily intake of the following?",
	"18. Indicate if you have any immediate family members with any of the following:",
	"19. For each of the conditions listed below, place a check in the 'past' column if you have had the condition in the past. If you presently have a condition listed below, place a check in the 'present' column.",
	"20. List all prescription & over the counter medications you are currently taking",
	"21. List any medications you are allergic to",
	"22. List any surgical procedures and/or hospitalizations you have had",
	"23. List any signifcant past trauma you have had",
	"24. What activities do you do at work?",
	"25. What concerns you the most about your problem?",
	"26. How much has the problem interfered with your work?",
	"27. Do you suffer from neck pain with pain in your shoulders, arms or hands?",
	"28. Do you have weaknessm, numbness, tingling or burning in your shoulders, arms or hands?",
	"29. Do your arms or hands fall asleep regularly?",
	"30. Do you have reduced feeling (sensation) or swelling in your arms or hands?",
	"31. Do you suffer from a loss of handgrip strength?",
	"32. Do you suffer from back pain with pain in your buttocks, legs or feet?",
	"33. Do you have weakness, numbness or burning in your buttocks, legs or feet?",
	"34. Do your legs or feet fall asleep regularly?",
	"35. Do you have reduced feeling (sensation) or swelling in your legs or foot?",
	"36. Do you suffer from cold hands or feet?",
	"37. Have you tried any Physical Therapy before?",
	"38. Have you tried any Chiropractic treatments before?",
	"39. Have you had an MRI?",
	"40. Have you had X-rays?",
	"41. Have you used any splint or braces or other prescribed treatments by an M.D.?",
	"42. Is there anything else pertinent to your visit today?",
	"Agreement:",
	);
$weightquestions = array(
	"1. Check ALL areas of treatment that interest you",
	"2. Did you know that all treatments above are 100% safe?",
	"3. Have you ever used any of the above treatments before?",
	"4. What do you consider to be your ideal weight?",
	"5. How much weight do you want to lose?",
	"6. When was the last time you were at your goal weight?",
	"7. How many times a year do you diet?",
	"8. What is stopping you from losing weight on your own?",
	"9. What have you tried in the past that has failed?",
	"10. Does your weight problem make you physically uncomfortable?",
	"11. Does your weight problem cause physical pain?",
	"12. Are you embarrassed by your excessive weight?",
	"13. Does being overweight and unhealty limit your activities?",
	"14. Do you binge eat?",
	"15. Do you suffer from uncontrollable cravings?",
	"16. Do you feel that food controls you?",
	"17. Do you eat because of your emotions?",
	"18. Do you eat between your meals?",
	"19. What do you choose to eat between meals?",
	"20. Do you feel that your eating behaviors are normal?",
	"21. Briefly descirbe your daily eating behaviors:",
	"22. Do you feel tired, run down, or out of energy?",
	"23. Is succesful weight loss a top priority?",
	"24. How fast do you want to be slim, trim, and fit?",
	"25. What is more important to you: fast or permanent?",
	"26. Does your family support your wieght loss efforts?",
	"27. Is your family excited that you're working with us?",
	"28. Can you remember being at your ideal weight?",
	"29. What do you remember most about it?",
	"30. Check the following conditions you would like help with or more information on:",
	"31. What is the most important element in deciding to use our services?"
);

$subject = "NEW PATIENT INTAKE FORM";

const TEMPIMGLOC = 'tempimg.png';

$dataURI = $_POST["imagevalue"];
$dataPieces = explode(',', $dataURI);
$encodedImg = $dataPieces[1];
$decodedImg = base64_decode($encodedImg);

file_put_contents(TEMPIMGLOC, $decodedImg);


const QUESTION_HEIGHT = 5;
const ANSWER_HEIGHT = 6;
const VERTICAL_MARGIN = 6;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTopMargin(VERTICAL_MARGIN);
$pdf->SetAutoPageBreak(true, VERTICAL_MARGIN);
$pdf->SetFont('Arial', "B", 15);
$pdf->MultiCell(0, 7, "Patient Info", 0, "L");
for ($i = 0; $i < count($clientinfo); $i++)
{
	$pdf->SetFont('Arial', "B", 9);
	$pdf->MultiCell(0, QUESTION_HEIGHT, $clientquestions[$i], 0, "L");
	$pdf->SetFont('Arial', "", 9);
	$pdf->MultiCell(0, ANSWER_HEIGHT, $clientinfo[$i], 0, "L");
	$pdf->Ln(1);
}
$pdf->SetFont('Arial', "B", 15);
$pdf->MultiCell(0, 7, "Insurance Information", 0, "L");
for ($i = 0; $i < count($insurance_info); $i++)
{
	$pdf->SetFont('Arial', "B", 9);
	$pdf->MultiCell(0, QUESTION_HEIGHT, $insurance_info_question[$i], 0, "L");
	$pdf->SetFont('Arial', "", 9);
	$pdf->MultiCell(0, ANSWER_HEIGHT, $insurance_info[$i], 0, "L");
	$pdf->Ln(1);
}
$pdf->SetFont('Arial', "B", 15);
$pdf->MultiCell(0, 10, "Questions answered", 0, "L");
$pdf->SetFont('Arial', "", 9);
for ($i = 0; $i < 42; $i++)
{
	$pdf->SetFont('Arial', "B", 9);
	$pdf->MultiCell(0, QUESTION_HEIGHT, $questions[$i], 0, "L");
	if ($i == 3)
	{
		$pdf->Image(TEMPIMGLOC);
		unlink(TEMPIMGLOC);
		$pdf->Ln(1);
		continue;
	}
	$pdf->SetFont('Arial', "", 9);
	$pdf->MultiCell(0, ANSWER_HEIGHT, $answers[$i], 0, "L");
	$pdf->Ln(1);
}
$pdf->SetFont('Arial', "B", 15);
$pdf->MultiCell(0, 9, "Weight Loss part", 0, "L");
$pdf->SetFont('Arial', "", 9);
for ($i = 0; $i < 31; $i++)
{
	$pdf->SetFont('Arial', "B", 9);
	$pdf->MultiCell(0, QUESTION_HEIGHT, $weightquestions[$i], 0, "L");
	$pdf->SetFont('Arial', "", 9);
	$answer = getWeightAnswer($i + 1);
	$pdf->MultiCell(0, ANSWER_HEIGHT, $answer, 0, "L");
	$pdf->Ln(1);
}
$pdf->SetFont('Arial', "B", 9);
$pdf->MultiCell(0, QUESTION_HEIGHT, $questions[42], 0, "L");
$pdf->SetFont('Arial', "", 9);
$pdf->MultiCell(0, ANSWER_HEIGHT, $answers[42], 0, "L");
$pdf->Ln(1);
$doc = $pdf->Output("S");

phpmailer();

header("Location: https://www.nycspinecare.com/thank-you.html");
die();

function getWeightAnswer($questionNr)
{
	$weightstring = "weight" . $questionNr;
	if ($questionNr === 1 || $questionNr === 30) // multiple
	{
		if ($questionNr === 1)
		{
			return strtoupper(implode(' and ', $_POST[$weightstring])) . "Other reason: " . $_POST["weight1other"];
		}
		return strtoupper(implode(' and ', $_POST[$weightstring]));
	}
	else if ($questionNr === 10 || $questionNr === 11  || $questionNr === 12  || $questionNr === 23)
	{
		return $_POST[$weightstring] . ", " . $_POST["weight" . $questionNr . "-d"];
	}
	return $_POST[$weightstring];
}

function manageIssues($issue, $kind = false)
{
	if (!$kind)
	{
		global $issuecounter;
		$issuestring = "issue" . $issuecounter;
		$issuecounter += 1;
		return strtoupper(implode(' and ', $_POST[$issuestring]));
	}
	else
	{
		return implode(', ', $_POST[$issue]);
	}
}

function phpmailer()
{
	global $subject, $message, $doc;
	$mail = new PHPMailer;
	$mail->From = 'info@nycspinecare.com';
	$mail->FromName = 'info@nycspinecare.com';
	$mail->setFrom("info@nycspinecare.com", "info@nycspinecare.com");
	$mail->addAddress('dacostaconsulting@gmail.com');     
	$mail->addAddress('drrandystephan@gmail.com');             
	$mail->addAddress('info@nycspinecare.com');
	$mail->addAddress('azeemshafqat24@gmail.com');
	$mail->addReplyTo('dacostaconsulting@gmail.com');

	$mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');

	$mail->isHTML(true);                    

	$mail->Subject = $subject;
	$mail->Body    = "Form as attachment.";
	$mail->AltBody = "Form as attachment.";

	$mail->send();
}
?>