<?php
lmb_require('src/model/DayJournalRecord.class.php');
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class DayJournalRecordTest extends odUnitTestCase
{
	function testFindWithLimitation()
	{
		$day1 = $this->generator->dayWithMoments();
		$this->generator->journalRecord($day1);
		$day2 = $this->generator->dayWithMoments();
		$this->generator->journalRecord($day2);
		$day3 = $this->generator->dayWithMoments();
		$this->generator->journalRecord($day3);
		$day4 = $this->generator->dayWithMoments();
		$this->generator->journalRecord($day4);
		$day5 = $this->generator->dayWithMoments();
		$day5->is_deleted = 1;
		$day5->save();
		$this->generator->journalRecord($day5);

		$days = DayJournalRecord::findDaysWithLimitation();
		if($this->assertEqual(4, count($days)))
		{
			$this->assertEqual($day4->id, $days[0]->id);
			$this->assertEqual($day3->id, $days[1]->id);
			$this->assertEqual($day2->id, $days[2]->id);
			$this->assertEqual($day1->id, $days[3]->id);
		}

		$days = DayJournalRecord::findDaysWithLimitation($day4->id);
		if($this->assertEqual(3, count($days)))
		{
			$this->assertEqual($day3->id, $days[0]->id);
			$this->assertEqual($day2->id, $days[1]->id);
			$this->assertEqual($day1->id, $days[2]->id);
		}

		$days = DayJournalRecord::findDaysWithLimitation($day4->id, $day1->id);
		if($this->assertEqual(2, count($days)))
		{
			$this->assertEqual($day3->id, $days[0]->id);
			$this->assertEqual($day2->id, $days[1]->id);
		}

		$days = DayJournalRecord::findDaysWithLimitation($day4->id, 1);
		if($this->assertEqual(1, count($days)))
		{
			$this->assertEqual($day3->id, $days[0]->id);
		}
	}
}
