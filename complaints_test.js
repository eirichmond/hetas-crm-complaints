
Feature('Complaints');

Scenario('Search Notifications', (I) => {
    I.amOnPage('https://hetas.test/hetas-complaints-questionnaire/');
    I.fillField('Notification Reference', '2000002');
    I.click('Search');
    I.wait(10);
    I.see('MILLHAM ROAD');
    I.selectOption('#nitems', 'ea5b64f3-bc2a-e911-80d2-00155d050ffd'); // select by label
    I.wait(3);
    I.see('Work Completion Date');
    I.click('Next');
    I.wait(2);
    I.see('Are you the Original Consumer?');
    I.click('#installation .navitabs-right a.active');
    I.wait(2);
    I.see('Were you provided with');
    I.click('#details .navitabs-right a.active');
    I.wait(2);
    I.see('Submit Complaint');
});

Scenario('Skip Nofitication Search', (I) => {
    I.amOnPage('https://hetas.test/hetas-complaints-questionnaire/');
    I.click('a.skip-notification-search');
    I.wait(3);
    I.see('Relationship to consumer');
});
