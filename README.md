# 🩸 BLOOD BANK MANAGEMENT SYSTEM

## Overview

The **Blood Bank Management System** is a full-stack web-based application developed in **PHP** and **MySQL**, designed to streamlines blood bank operations of a blood bank. It supports managing donor and patient data, monitoring blood inventory, scheduling hospital staff, and coordinating with hospitals and donation camps. The project was built as part of the Database Management Systems course at **NED University of Engineering and Technology**.

---

## Authors

- **Atika Imam**   
- **Aiman Nasir**  
- **Soha Haider** 
- **Emaan Khan**  

---

## Key Features

### Authentication & Security
- Secure login/logout system (admin access only)
- Session-based authentication
- Role-based access control
- SQL injection prevention using prepared statements

### Donor & Patient Management
- Donor registration with medical history
- Patient registration with disease details
- Matching compatible donors for patient requests

### Blood Inventory & Requests
- Real-time blood stock monitoring by blood group
- Blood request tracking and approval
- Expiry date tracking and alert system
- Temperature monitoring placeholders

### Hospital & Volunteer Coordination
- Hospital and camp location registration
- Volunteer, doctor, and nurse scheduling
- Ambulance and transportation request handling

### Administrative Modules
- Billing and financial record keeping
- Compliance and test report management
- Feedback collection system
  
---

## Technologies Used

- **Frontend**: HTML5, CSS3  
- **Backend**: PHP 7.4+  
- **Database**: MySQL  
- **Server**: Apache (XAMPP)  
- **IDE**: Visual Studio Code  
- **Security**: Session authentication
---

## Code Structure

### Database & Security

- 25+ Entities normalized to **2NF**
- Entity types: Users, Donors, Patients, Blood Stock, Medical Staff, Locations, Feedback
- Foreign keys used for `blood_group`, `gender`, `specialization` via lookup tables 
- Input validation and SQL injection protection

# Flowchart
![image](https://github.com/user-attachments/assets/dc14e0f3-5cac-4fe0-8692-da9e2e86c74a)



  
# Database Normalization
## Issues in 1NF (Before Normalization)
- **Redundant data** caused anomalies:
  - **Update issues**: Changing values (like gender/blood group) required multiple updates
  - **Insert issues**: Adding records often meant duplicating data
  - **Delete issues**: Removing records could accidentally delete important information

## Changes Made for 2NF
1. **Created lookup tables** for:
   - Gender
   - Blood groups
   - Specializations

2. **Modified main tables** to use foreign keys instead of repeating text:
   - `gender_id` instead of gender text
   - `blood_group_id` instead of blood group text
   - etc.

## Benefits of 2NF - To make database more efficient and maintain better data consistency.
**Eliminated update anomalies** - Change values in one place only  
**Fixed insert issues** - Just reference IDs, no duplicate data entry  
**Prevented delete problems** - Removing records keeps lookup data intact  

---

## Module Descriptions
Some of the core files include:
| File | Description |
|------|-------------|
| `index.php` | Landing page |
| `loginpage.php` | Admin login interface |
| `db_config.php` | Database connection settings |
| `add_donor.php` | Donor registration |
| `donor_medical_history_insert.php` | Donor health history |
| `blood_request_insert.php` | Patient blood request |
| `add_available_blood_stock.php` | Add available blood stock |
| `search.php` | Search blood availability |
| `doctor_details.php`, `nurse_insert.php` | Medical staff management |
| `hospital_insert.php`, `camp_location_insert.php` | Hospital and camp data |
| `ambulance_request_insert.php` | Emergency transport requests |

---

## How It Works

1. **Admin logs in** using a secure password system.
2. **Donors and patients are registered** through their respective forms.
3. **Blood requests** can be made and are matched with compatible donors.
4. **Blood Stock** is updated automatically ensuring real-time inventory accuracy and availability.
5. **Inventory** is tracked for availability, expiry, and temperature.
6. **Hospitals, camps, and volunteers** are managed via forms.
7. **Reports and feedback** are stored and reviewed.
8. **Secure logout functionality** has been implemented for user to logout from the dashboard.

---

## Future Enhancements

- Mobile application integration
- SMS/email alerts for critical needs
- Advanced analytics dashboard
- AI for predicting demand & donor suggestions 
- Multi-language support  
- Two-factor admin authentication
- Multi-language support
- API integration with hospital EHR systems  
- Barcode scanning for blood units tracking

---

## PROVIDE BLOOD AND SAVE LIVES!
