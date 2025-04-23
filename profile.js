// User Profile Backend Integration
document.addEventListener("DOMContentLoaded", function () {
  // DOM Elements
  const menuToggle = document.querySelector(".menu-toggle");
  const tabButtons = document.querySelectorAll(".tab-btn");
  const tabSections = document.querySelectorAll(".profile-section");
  const profileForm = document.getElementById("profileForm");
  const securityForm = document.getElementById("securityForm");
  const preferencesForm = document.getElementById("preferencesForm");
  const cancelBtn = document.getElementById("cancelBtn");
  const changePhotoBtn = document.getElementById("changePhotoBtn");
  const avatarUpload = document.getElementById("avatarUpload");
  const userAvatar = document.getElementById("userAvatar");
  const activityTypeFilter = document.getElementById("activityTypeFilter");
  const activityDateFilter = document.getElementById("activityDateFilter");
  const activityList = document.getElementById("activityList");
  const toast = document.getElementById("toast");
  const toastMessage = document.getElementById("toastMessage");

  // Mock user data (in a real app, this would come from an API)
  let userData = {
    id: 1,
    firstName: "Sourodip",
    lastName: "Dey",
    email: "s.dey@gmail.com",
    phone: "9434132014",
    position: "Inventory Manager",
    bio: "Experienced inventory manager with 5+ years in retail and e-commerce. Specializing in optimizing stock levels and improving warehouse efficiency.",
    avatar: "https://via.placeholder.com/150",
    accountType: "Administrator",
    memberSince: "December 13, 2024",
    lastLogin: new Date().toLocaleString("en-US", {
      weekday: "short",
      month: "short",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    }),
    twoFactorEnabled: true,
    preferences: {
      theme: "light",
      language: "en",
      timezone: "EST",
      emailNotifications: true,
    },
  };

  // Mock activity data
  let activityData = [
    {
      id: 1,
      type: "login",
      title: "Successful Login",
      description: "Logged in from Chrome on Windows",
      time: "2 minutes ago",
      icon: "fa-sign-in-alt",
    },
    {
      id: 2,
      type: "settings",
      title: "Profile Updated",
      description: "Changed profile information",
      time: "1 hour ago",
      icon: "fa-user-edit",
    },
    {
      id: 3,
      type: "inventory",
      title: "Inventory Updated",
      description: "Added 15 new items to stock",
      time: "3 hours ago",
      icon: "fa-boxes",
    },
    {
      id: 4,
      type: "login",
      title: "Failed Login Attempt",
      description: "Failed login from unknown device",
      time: "Yesterday",
      icon: "fa-exclamation-triangle",
    },
    {
      id: 5,
      type: "settings",
      title: "Password Changed",
      description: "Account password was updated",
      time: "2 days ago",
      icon: "fa-key",
    },
  ];

  // Initialize the page
  function initPage() {
    // Load user data into form
    loadUserData();

    // Load activity log
    renderActivityLog();

    // Set up event listeners
    setupEventListeners();
  }

  // Load user data into the form
  function loadUserData() {
    document.getElementById("firstName").value = userData.firstName;
    document.getElementById("lastName").value = userData.lastName;
    document.getElementById("email").value = userData.email;
    document.getElementById("phone").value = userData.phone;
    document.getElementById("position").value = userData.position;
    document.getElementById("bio").value = userData.bio;
    document.getElementById("accountType").textContent = userData.accountType;
    document.getElementById("memberSince").textContent = userData.memberSince;
    document.getElementById("lastLogin").textContent = userData.lastLogin;
    document.getElementById("twoFactorStatus").textContent =
      userData.twoFactorEnabled ? "Enabled" : "Disabled";
    document.getElementById("twoFactorAuth").checked =
      userData.twoFactorEnabled;
    userAvatar.src = userData.avatar;

    // Load preferences
    if (userData.preferences) {
      document.getElementById("theme").value = userData.preferences.theme;
      document.getElementById("language").value = userData.preferences.language;
      document.getElementById("timezone").value = userData.preferences.timezone;
      document.getElementById("emailNotifications").checked =
        userData.preferences.emailNotifications;
    }
  }

  // Set up event listeners
  function setupEventListeners() {
    // Toggle sidebar on mobile
    menuToggle.addEventListener("click", toggleSidebar);

    // Tab switching
    tabButtons.forEach((button) => {
      button.addEventListener("click", () => switchTab(button.dataset.tab));
    });

    // Profile form submission
    profileForm.addEventListener("submit", handleProfileUpdate);

    // Security form submission
    securityForm.addEventListener("submit", handleSecurityUpdate);

    // Preferences form submission
    preferencesForm.addEventListener("submit", handlePreferencesUpdate);

    // Cancel button
    cancelBtn.addEventListener("click", resetForm);

    // Change photo button
    changePhotoBtn.addEventListener("click", () => avatarUpload.click());

    // Avatar upload
    avatarUpload.addEventListener("change", handleAvatarUpload);

    // Activity log filters
    activityTypeFilter.addEventListener("change", renderActivityLog);
    activityDateFilter.addEventListener("change", renderActivityLog);
  }

  // Toggle sidebar
  function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
  }

  // Switch between tabs
  function switchTab(tabId) {
    // Update active tab button
    tabButtons.forEach((button) => {
      button.classList.toggle("active", button.dataset.tab === tabId);
    });

    // Show/hide tab sections
    tabSections.forEach((section) => {
      section.classList.toggle("hidden", section.id !== `${tabId}-tab`);
    });
  }

  // Handle profile update
  function handleProfileUpdate(e) {
    e.preventDefault();

    // Get form data
    const formData = {
      firstName: document.getElementById("firstName").value,
      lastName: document.getElementById("lastName").value,
      email: document.getElementById("email").value,
      phone: document.getElementById("phone").value,
      position: document.getElementById("position").value,
      bio: document.getElementById("bio").value,
    };

    // Validate email
    if (!validateEmail(formData.email)) {
      showToast("Please enter a valid email address", "error");
      return;
    }

    // In a real app, you would send this to your backend API
    // For now, we'll just update our mock data
    userData = { ...userData, ...formData };

    // Update the UI to reflect changes
    document.querySelector(
      ".user-name"
    ).textContent = `${formData.firstName} ${formData.lastName}`;

    // Show success message
    showToast("Profile updated successfully", "success");

    // Add to activity log
    addActivityLog(
      "settings",
      "Profile Updated",
      "Changed profile information"
    );
  }

  // Handle security update
  function handleSecurityUpdate(e) {
    e.preventDefault();

    const currentPassword = document.getElementById("currentPassword").value;
    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const twoFactorEnabled = document.getElementById("twoFactorAuth").checked;

    // Validate passwords
    if (newPassword !== confirmPassword) {
      showToast("New passwords do not match", "error");
      return;
    }

    if (newPassword.length < 8) {
      showToast("Password must be at least 8 characters", "error");
      return;
    }

    // In a real app, you would verify current password with backend
    // Then update the password and 2FA settings

    // Update mock data
    userData.twoFactorEnabled = twoFactorEnabled;
    document.getElementById("twoFactorStatus").textContent = twoFactorEnabled
      ? "Enabled"
      : "Disabled";

    // Clear form
    securityForm.reset();

    // Show success message
    showToast("Security settings updated successfully", "success");

    // Add to activity log
    addActivityLog(
      "settings",
      "Security Updated",
      twoFactorEnabled
        ? "Enabled two-factor authentication"
        : "Disabled two-factor authentication"
    );
  }

  // Handle preferences update
  function handlePreferencesUpdate(e) {
    e.preventDefault();

    const preferences = {
      theme: document.getElementById("theme").value,
      language: document.getElementById("language").value,
      timezone: document.getElementById("timezone").value,
      emailNotifications: document.getElementById("emailNotifications").checked,
    };

    // In a real app, you would send this to your backend API
    userData.preferences = preferences;

    // Apply theme immediately (just for demo)
    if (preferences.theme === "dark") {
      document.documentElement.style.setProperty("--bg-color", "#1a1a1a");
      document.documentElement.style.setProperty("--card-bg", "#2a2a2a");
      document.documentElement.style.setProperty("--text-color", "#f0f0f0");
      document.documentElement.style.setProperty("--light-text", "#a0a0a0");
      document.documentElement.style.setProperty("--border-color", "#444");
    } else {
      document.documentElement.style.setProperty("--bg-color", "#f8f9fa");
      document.documentElement.style.setProperty("--card-bg", "#fff");
      document.documentElement.style.setProperty("--text-color", "#333");
      document.documentElement.style.setProperty("--light-text", "#777");
      document.documentElement.style.setProperty("--border-color", "#e0e0e0");
    }

    // Show success message
    showToast("Preferences updated successfully", "success");

    // Add to activity log
    addActivityLog(
      "settings",
      "Preferences Updated",
      "Changed user preferences"
    );
  }

  // Reset form to original values
  function resetForm() {
    loadUserData();
    showToast("Changes discarded", "warning");
  }

  // Handle avatar upload
  function handleAvatarUpload(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!file.type.match("image.*")) {
      showToast("Please select an image file", "error");
      return;
    }

    if (file.size > 2 * 1024 * 1024) {
      // 2MB limit
      showToast("Image size should be less than 2MB", "error");
      return;
    }

    // In a real app, you would upload this to your server
    // For demo, we'll just create a local URL
    const reader = new FileReader();
    reader.onload = function (event) {
      userAvatar.src = event.target.result;
      userData.avatar = event.target.result;
      showToast("Profile picture updated", "success");
      addActivityLog("settings", "Avatar Updated", "Changed profile picture");
    };
    reader.readAsDataURL(file);
  }

  // Render activity log
  function renderActivityLog() {
    const typeFilter = activityTypeFilter.value;
    const dateFilter = activityDateFilter.value;

    let filteredActivities = activityData;

    // Apply type filter
    if (typeFilter !== "all") {
      filteredActivities = filteredActivities.filter(
        (activity) => activity.type === typeFilter
      );
    }

    // Apply date filter (simplified for demo)
    if (dateFilter) {
      filteredActivities = filteredActivities.filter((activity) => {
        // In a real app, you would compare actual dates
        return (
          activity.time.includes("minutes") || activity.time.includes("hour")
        );
      });
    }

    // Clear current activities
    activityList.innerHTML = "";

    // Add filtered activities
    if (filteredActivities.length === 0) {
      activityList.innerHTML =
        '<p class="no-activities">No activities found</p>';
      return;
    }

    filteredActivities.forEach((activity) => {
      const activityItem = document.createElement("div");
      activityItem.className = "activity-item";
      activityItem.innerHTML = `
                <div class="activity-icon">
                    <i class="fas ${activity.icon}"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">${activity.title}</div>
                    <div class="activity-description">${activity.description}</div>
                    <div class="activity-time">${activity.time}</div>
                </div>
            `;
      activityList.appendChild(activityItem);
    });
  }

  // Add to activity log
  function addActivityLog(type, title, description) {
    const now = new Date();
    let timeString;

    // Simple time formatting for demo
    const minutesAgo = Math.floor(Math.random() * 60);
    if (minutesAgo < 1) {
      timeString = "Just now";
    } else if (minutesAgo < 60) {
      timeString = `${minutesAgo} minute${minutesAgo === 1 ? "" : "s"} ago`;
    } else {
      const hoursAgo = Math.floor(minutesAgo / 60);
      timeString = `${hoursAgo} hour${hoursAgo === 1 ? "" : "s"} ago`;
    }

    const newActivity = {
      id: activityData.length + 1,
      type,
      title,
      description,
      time: timeString,
      icon: getActivityIcon(type),
    };

    activityData.unshift(newActivity);
    renderActivityLog();
  }

  // Get appropriate icon for activity type
  function getActivityIcon(type) {
    switch (type) {
      case "login":
        return "fa-sign-in-alt";
      case "settings":
        return "fa-cog";
      case "inventory":
        return "fa-boxes";
      default:
        return "fa-info-circle";
    }
  }

  // Show toast notification
  function showToast(message, type = "info") {
    toastMessage.textContent = message;
    toast.className = `toast show ${type}`;

    setTimeout(() => {
      toast.classList.remove("show");
    }, 3000);
  }

  // Simple email validation
  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  // Initialize the page
  initPage();
});
