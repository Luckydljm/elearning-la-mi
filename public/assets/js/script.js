// instruktur
$(document).ready(function () {
  let t = $('#instructorTable').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
    buttons: ['pageLength', 'excel', 'pdf', 'colvis'],
  });

  $('.btn-delete-instructor').click(function () {
    let id = $(this).data('id');
    let email = $(this).attr('data-email');
    $('.id_instructor').val(id);
    $('.email').empty();
    $('.email').append(email);
  });
});

// admin
$(document).ready(function () {
  let t = $('#adminTable').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
    buttons: ['pageLength', 'excel', 'pdf', 'colvis'],
  });

  $('.btn-delete-admin').click(function () {
    let id = $(this).data('id');
    let email = $(this).attr('data-email');
    $('.id_admin').val(id);
    $('.email').empty();
    $('.email').append(email);
  });
});

// user
$(document).ready(function () {
  let t = $('#userTable').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
    buttons: ['pageLength', 'excel', 'pdf', 'colvis'],
  });

  $('.btn-delete-user').click(function () {
    let id = $(this).data('id');
    let email = $(this).attr('data-email');
    $('.id_users').val(id);
    $('.email').empty();
    $('.email').append(email);
  });
});

// category
$(document).ready(function () {
  $('.btn-delete-category').click(function () {
    let id = $(this).data('id');
    let name = $(this).attr('data-name');
    $('.id_category').val(id);
    $('.name').empty();
    $('.name').append(name);
  });

  $('.btn-edit-category').click(function () {
    let id = $(this).data('id');
    let code = $(this).attr('data-code');
    let name = $(this).attr('data-name');
    let thumbnail = $(this).attr('data-thumbnail');
    $('.id_category').val(id);
    $('.code').attr('value', code);
    $('.name').attr('value', name);
    $('.thumbnail').attr('value', thumbnail);
  });
});

// sub category
$(document).ready(function () {
  $('#subCategoryTable').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
    buttons: ['pageLength', 'excel', 'pdf', 'colvis'],
  });

  $('.btn-delete-subCategory').click(function () {
    let id = $(this).data('id');
    let name_sub = $(this).attr('data-name_sub');
    $('.id_sub_category').val(id);
    $('.name_sub').empty();
    $('.name_sub').append(name_sub);
  });
});

// course
$(document).ready(function () {
  $('#courseTable').DataTable({
    stateSave: true,
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
  });

  $('.btn-delete-course').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    $('.id_course').val(id);
    $('.title').empty();
    $('.title').append(title);
  });
});

// results
$(document).ready(function () {
  $('#resultsTable').DataTable({
    stateSave: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [5, 10, 15, -1],
      ['5', '10', '15', 'All'],
    ],
    buttons: ['pageLength', 'excel', 'pdf', 'colvis'],
  });
});

// lesson
$(document).ready(function () {
  $('.btn-delete-lesson').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    $('.id_lesson').val(id);
    $('.title').empty();
    $('.title').append(title);
  });

  $('.btn-edit-quiz').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    let summary = $(this).attr('data-summary');
    $('.id_lesson').val(id);
    $('.title').attr('value', title);
    $('.summary').text(summary);
  });

  $('.btn-edit-lesson').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    let summary = $(this).attr('data-summary');
    $('.id_lesson').val(id);
    $('.title').attr('value', title);
    $('.summary').text(summary);
  });
});

// question
$(document).ready(function () {
  $('.btn-delete-question').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    $('.id_question').val(id);
    $('.title').empty();
    $('.title').append(title);
  });

  $('.btn-edit-question').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    let option_a = $(this).attr('data-option_a');
    let option_b = $(this).attr('data-option_b');
    let option_c = $(this).attr('data-option_c');
    let option_d = $(this).attr('data-option_d');
    let correct_answers = $(this).attr('data-correct_answers');
    $('.id_question').val(id);
    $('.title').text(title);
    $('.option_a').attr('value', option_a);
    $('.option_b').attr('value', option_b);
    $('.option_c').attr('value', option_c);
    $('.option_d').attr('value', option_d);
    $('.correct_answers').attr('value', correct_answers);
  });
});

// section
$(document).ready(function () {
  $('.btn-delete-section').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    $('.id_section').val(id);
    $('.title').empty();
    $('.title').append(title);
  });

  $('.btn-edit-section').click(function () {
    let id = $(this).data('id');
    let title = $(this).attr('data-title');
    $('.id_section').val(id);
    $('.title').attr('value', title);
  });
});

// enrol
$(document).ready(function () {
  $('#enrolTable').DataTable({
    stateSave: true,
    lengthMenu: [
      [10, 15, 25, -1],
      ['10', '15', '25', 'All'],
    ],
  });

  $('.btn-delete-enrol').click(function () {
    let id = $(this).data('id');
    let first_name = $(this).attr('data-first_name');
    let last_name = $(this).attr('data-last_name');
    let title = $(this).attr('data-title');
    $('.id_enrol').val(id);
    $('.title').empty();
    $('.title').append(title);
    $('.first_name').empty();
    $('.first_name').append(first_name);
    $('.last_name').empty();
    $('.last_name').append(last_name);
  });
});

// SmartWizard initialize
$(function () {
  $('#smartwizard').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'default', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    backButtonSupport: true, // Enable the back button support
    enableUrlHash: true, // Enable selection of the step based on url hash
    transition: {
      animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: '400', // Animation speed. Not used if animation is 'css'
      easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
      prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
      fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
      fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
      bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
      bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
    },
    toolbar: {
      position: 'bottom', // none|top|bottom|both
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      extraHtml: '', // Extra html to show on toolbar
    },
    anchor: {
      enableNavigation: true, // Enable/Disable anchor navigation
      enableNavigationAlways: false, // Activates all anchors clickable always
      enableDoneState: true, // Add done state on visited steps
      markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
      unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
      enableDoneStateNavigation: true, // Enable/Disable the done state navigation
    },
    keyboard: {
      keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      keyLeft: [37], // Left key code
      keyRight: [39], // Right key code
    },
    lang: {
      // Language variables for button
      next: 'Next',
      previous: 'Previous',
    },
    disabledSteps: [], // Array Steps disabled
    errorSteps: [], // Array Steps error
    warningSteps: [], // Array Steps warning
    hiddenSteps: [], // Hidden steps
    getContent: null, // Callback function for content loading
  });
});

$(function () {
  $('#smartwizard2').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'default', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    backButtonSupport: true, // Enable the back button support
    enableUrlHash: true, // Enable selection of the step based on url hash
    transition: {
      animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: '400', // Animation speed. Not used if animation is 'css'
      easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
      prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
      fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
      fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
      bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
      bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
    },
    toolbar: {
      position: 'bottom', // none|top|bottom|both
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      extraHtml: '', // Extra html to show on toolbar
    },
    anchor: {
      enableNavigation: true, // Enable/Disable anchor navigation
      enableNavigationAlways: false, // Activates all anchors clickable always
      enableDoneState: true, // Add done state on visited steps
      markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
      unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
      enableDoneStateNavigation: true, // Enable/Disable the done state navigation
    },
    keyboard: {
      keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      keyLeft: [37], // Left key code
      keyRight: [39], // Right key code
    },
    lang: {
      // Language variables for button
      next: 'Next',
      previous: 'Previous',
    },
    disabledSteps: [], // Array Steps disabled
    errorSteps: [], // Array Steps error
    warningSteps: [], // Array Steps warning
    hiddenSteps: [], // Hidden steps
    getContent: null, // Callback function for content loading
  });
});

$(function () {
  $('#smartwizard3').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'default', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    backButtonSupport: true, // Enable the back button support
    enableUrlHash: true, // Enable selection of the step based on url hash
    transition: {
      animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: '400', // Animation speed. Not used if animation is 'css'
      easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
      prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
      fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
      fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
      bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
      bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
    },
    toolbar: {
      position: 'bottom', // none|top|bottom|both
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      extraHtml: '', // Extra html to show on toolbar
    },
    anchor: {
      enableNavigation: true, // Enable/Disable anchor navigation
      enableNavigationAlways: false, // Activates all anchors clickable always
      enableDoneState: true, // Add done state on visited steps
      markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
      unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
      enableDoneStateNavigation: true, // Enable/Disable the done state navigation
    },
    keyboard: {
      keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      keyLeft: [37], // Left key code
      keyRight: [39], // Right key code
    },
    lang: {
      // Language variables for button
      next: 'Next',
      previous: 'Previous',
    },
    disabledSteps: [], // Array Steps disabled
    errorSteps: [], // Array Steps error
    warningSteps: [], // Array Steps warning
    hiddenSteps: [], // Hidden steps
    getContent: null, // Callback function for content loading
  });
});

$(function () {
  $('#smartwizard4').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'default', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    backButtonSupport: true, // Enable the back button support
    enableUrlHash: true, // Enable selection of the step based on url hash
    transition: {
      animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: '400', // Animation speed. Not used if animation is 'css'
      easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
      prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
      fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
      fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
      bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
      bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
    },
    toolbar: {
      position: 'bottom', // none|top|bottom|both
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      extraHtml: '', // Extra html to show on toolbar
    },
    anchor: {
      enableNavigation: true, // Enable/Disable anchor navigation
      enableNavigationAlways: false, // Activates all anchors clickable always
      enableDoneState: true, // Add done state on visited steps
      markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
      unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
      enableDoneStateNavigation: true, // Enable/Disable the done state navigation
    },
    keyboard: {
      keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      keyLeft: [37], // Left key code
      keyRight: [39], // Right key code
    },
    lang: {
      // Language variables for button
      next: 'Next',
      previous: 'Previous',
    },
    disabledSteps: [], // Array Steps disabled
    errorSteps: [], // Array Steps error
    warningSteps: [], // Array Steps warning
    hiddenSteps: [], // Hidden steps
    getContent: null, // Callback function for content loading
  });
});

$(function () {
  $('#smartwizard5').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'default', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    backButtonSupport: true, // Enable the back button support
    enableUrlHash: true, // Enable selection of the step based on url hash
    transition: {
      animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: '400', // Animation speed. Not used if animation is 'css'
      easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
      prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
      fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
      fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
      bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
      bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
    },
    toolbar: {
      position: 'bottom', // none|top|bottom|both
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      extraHtml: '', // Extra html to show on toolbar
    },
    anchor: {
      enableNavigation: true, // Enable/Disable anchor navigation
      enableNavigationAlways: false, // Activates all anchors clickable always
      enableDoneState: true, // Add done state on visited steps
      markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
      unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
      enableDoneStateNavigation: true, // Enable/Disable the done state navigation
    },
    keyboard: {
      keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      keyLeft: [37], // Left key code
      keyRight: [39], // Right key code
    },
    lang: {
      // Language variables for button
      next: 'Next',
      previous: 'Previous',
    },
    disabledSteps: [], // Array Steps disabled
    errorSteps: [], // Array Steps error
    warningSteps: [], // Array Steps warning
    hiddenSteps: [], // Hidden steps
    getContent: null, // Callback function for content loading
  });
});

// Summernote initialize
$(document).ready(function () {
  $('#textEditor').summernote({
    height: 200,
  });
});
