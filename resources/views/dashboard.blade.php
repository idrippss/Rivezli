<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-11">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Welcome back, Jessica Grande") }}
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard mt-8 grid grid-cols-3 gap-6">
            <!-- Continue Course Section -->
            <div class="box continue-course col-span-2">
                <h2>Continue Course</h2>
                <!-- Add course items here -->
                <div class="course-item">
                    <img src="path-to-image" alt="Course Image">
                    <p>How to Write Advertising Copy</p>
                    <span>Adam Levine</span>
                </div>
                <div class="course-item">
                    <img src="path-to-image" alt="Course Image">
                    <p>Street Photography for Beginner</p>
                    <span>ASIA Photo School</span>
                </div>
            </div>

            <!-- Hours Spent Section -->
            <div class="box hours-spent">
                <h2>Hours Spent</h2>
                <canvas id="hoursSpentChart"></canvas>
            </div>

            <!-- Your Courses Section -->
            <div class="box your-courses col-span-2">
                <h2>Your Courses</h2>
                <a href="#">View All</a>
                <!-- Add courses here -->
                <div class="course-item">
                    <p>Copywriting for User Experience Design</p>
                    <span>Mohamed Lewis</span>
                </div>
                <div class="course-item">
                    <p>The 5 Steps to Presenting Like a Pro</p>
                    <span>Fernandez Diaz</span>
                </div>
                <div class="course-item">
                    <p>Conducting UX Research: Steps to ...</p>
                    <span>Susanne Polzky</span>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="box statistics">
                <h2>Statistics</h2>
                <canvas id="statisticsChart"></canvas>
            </div>

            <!-- Assignments Section -->
            <div class="box assignments col-span-2">
                <h2>Assignments</h2>
                <a href="#">See All</a>
                <!-- Add assignments here -->
                <div class="assignment-item">
                    <p>Simple Copywriting</p>
                    <span>Due in 3 days</span>
                </div>
                <div class="assignment-item">
                    <p>Presentation Task</p>
                    <span>Due in 3 days</span>
                </div>
            </div>

            <!-- Completed Courses Section -->
            <div class="box completed">
                <h2>Completed Courses</h2>
                <!-- Add completed courses here -->
                <div class="completed-item">
                    <p>Getting Started with UI Design</p>
                    <span>Score 94</span>
                </div>
                <div class="completed-item">
                    <p>Beginner's Guide to Freelancing</p>
                    <span>Score 80</span>
                </div>
            </div>

            <!-- Top Instructors Section -->
            <div class="box top-instructors">
                <h2>Top Instructors</h2>
                <!-- Add instructors here -->
                <div class="instructor-item">
                    <p>Leslie Alexander</p>
                    <span>20 Courses</span>
                </div>
                <div class="instructor-item">
                    <p>Brooklyn Simmons</p>
                    <span>12 Courses</span>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Script to render charts (Hours Spent, Statistics)
        const hoursSpentCtx = document.getElementById('hoursSpentChart').getContext('2d');
        const statisticsCtx = document.getElementById('statisticsChart').getContext('2d');

        const hoursSpentChart = new Chart(hoursSpentCtx, {
            type: 'line',
            data: {
                // Add your data here
            },
            options: {
                // Add your options here
            }
        });

        const statisticsChart = new Chart(statisticsCtx, {
            type: 'doughnut',
            data: {
                // Add your data here
            },
            options: {
                // Add your options here
            }
        });
    </script>
</body>
</html>
